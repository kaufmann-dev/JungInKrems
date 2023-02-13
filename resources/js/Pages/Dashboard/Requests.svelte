<script>
    import { router } from '@inertiajs/svelte';
    import Button from '../../Shared/Button.svelte';
    import DashLayout from '../../Shared/DashLayout.svelte'
    import Form from '../../Shared/Form.svelte';
    import H1 from '../../Shared/H1.svelte';
    import Table from '../../Shared/Table.svelte'
    import HR from '../../Shared/HR.svelte';
    import InfoText from '../../Shared/InfoText.svelte';

    export let requests = [];
    let editing = false;
    let index = 0;

    $: data = requests.map(request => {
        return {
            "ID": request.REQUEST_ID,
            "Typ": request.REQUEST_TYPE,
            "Antragsteller": request.account.NAME,
            "Bildungsanstalt": request.facility.NAME,
            "Nachricht": request.MESSAGE,
            "Status": request.STATUS,
        }
    });

    $: formData = [
        {
            name: "Anstragssteller-ID",
            type: "text",
            value: {...requests[index]}.ACCOUNT_ID,
            bind: "ACCOUNT_ID",
            errorname: "ACCOUNT_ID",
            error: ""
        },
        {
            name: "Einrichtungs-ID",
            type: "text",
            value: {...requests[index]}.FACILITY_ID,
            bind: "FACILITY_ID",
            errorname: "FACILITY_ID",
            error: ""
        },
        {
            name: "Nachricht",
            type: "text",
            value: {...requests[index]}.MESSAGE,
            bind: "MESSAGE",
            errorname: "MESSAGE",
            error: ""
        },
        {
            name: "Status",
            type: "array",
            options: [{
                name: "Offen",
                value: "Offen"
            }, {
                name: "Abgelehnt",
                value: "Abgelehnt"
            }, {
                name: "Angenommen",
                value: "Angenommen"
            }],
            value: {...requests[index]}.STATUS,
            bind: "STATUS",
            errorname: "STATUS",
            error: ""
        },
        {
            name: "Typ",
            type: "array",
            options : [{
                name: "Freischaltung",
                value: "Freischaltung"
            }, {
                name: "Sonstiges",
                value: "Sonstiges"
            }],
            value: {...requests[index]}.REQUEST_TYPE,
            bind: "REQUEST_TYPE",
            errorname: "REQUEST_TYPE",
            error: ""
        }
    ]

    function handleAccept(event){
        axios.post('/admin/requests/accept/' + {...requests[event.detail]}.REQUEST_ID);
        router.reload();
    }

    function handleDecline(event){
        axios.post('/admin/requests/decline/' + {...requests[event.detail]}.REQUEST_ID);
        router.reload();
    }

    function handleDeletion(event){
        if(!confirm("Wollen Sie diesen Antrag wirklich löschen?"))     
            return;
        axios.post('/requests/delete/' + {...requests[event.detail]}.REQUEST_ID);
        router.reload();
    }

    function handleEdit(event){
        index = event.detail;
        editing = true;
    }

    let cancel = () => {
        editing = false;
    }

    let deletion = () => {
        if(!confirm("Wollen Sie diesen Antrag wirklich löschen?"))     
            return;
        axios.post('/requests/delete/' + {...requests[index]}.REQUEST_ID);
        editing = false;
        router.reload();
    }

    let submit = () => {
        let submitdata = formData.map(element => {
            if(element["value"] !== "" && element["value"] !== "NaN-NaN-NaNTNaN:NaN" && element["value"] !== null) {
            return {
                [element["bind"]]: element["value"]
            }
        }
        }).reduce((a, b) => Object.assign(a, b), {});

        axios.post('/admin/requests/' + {...requests[index]}.REQUEST_ID, submitdata)
            .then(response => {
                editing = false;
                router.reload();
            })
            .catch(error => {
                console.log(error);
                if (error?.response?.status === 422) {
                    for (const [key, value] of Object.entries(formData)) {
                        if(error.response.data.errors[value["errorname"]]) {
                            formData[key]["error"] = error.response.data.errors[value["errorname"]][0];
                        } else {
                            formData[key]["error"] = "";
                        }
                    }
                }
            });
    }
</script>

<DashLayout>
    <H1 mb={false}>Anträge</H1>
    <HR/>
    {#if editing}
        <Form onSubmit={submit} onDelete={deletion} onCancel={cancel} newInstance={false} data={formData}></Form>
    {:else}
        {#if requests.length == 0}
            <InfoText mb="true" color="light">Keine Anträge vorhanden.</InfoText>
        {:else}
            <Table on:editData={handleEdit} on:deleteData={handleDeletion} on:decline={handleDecline} on:accept={handleAccept} bind:data={data}></Table>
        {/if}
        <div></div>
        <Button link="/account/requests">Antrag erstellen</Button>
    {/if}
</DashLayout>