<script>
    import { router } from '@inertiajs/svelte';
    import axios from 'axios';
    import Button from '../../Shared/Button.svelte';
    import DashLayout from '../../Shared/DashLayout.svelte'
    import Form from '../../Shared/Form.svelte';
    import H1 from '../../Shared/H1.svelte';
    import Table from '../../Shared/Table.svelte'
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
            name: "ID",
            type: "text",
            value: {...requests[index]}.REQUEST_ID,
            bind: "REQUEST_ID",
            errorname: "REQUEST_ID",
            error: ""
        },
        {
            name: "Anstragssteller ID",
            type: "text",
            value: {...requests[index]}.ACCOUNT_ID,
            bind: "ACCOUNT_ID",
            errorname: "ACCOUNT_ID",
            error: ""
        },
        {
            name: "Bildungsanstalt ID",
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
        axios.post('/request-accept/' + {...requests[event.detail]}.REQUEST_ID);
        router.reload();
    }

    function handleDecline(event){
        axios.post('/request-decline/' + {...requests[event.detail]}.REQUEST_ID);
        router.reload();
    }

    function handleDeletion(event){
        if(!confirm("Wollen Sie diesen Antrag wirklich löschen?"))     
            return;
        axios.delete('/requests/' + {...requests[event.detail]}.REQUEST_ID);
        router.reload();
    }

    function handleEdit(event){
        index = event.detail;
        console.log(event.detail);
        editing = true;
    }

    let cancel = () => {
        editing = false;
    }

    let deletion = () => {
        if(!confirm("Wollen Sie diesen Antrag wirklich löschen?"))     
            return;
        axios.delete('/requests/' + {...requests[index]}.REQUEST_ID);
        editing = false;
        router.reload();
    }

    let submit = () => {
        let submitdata = formData.map(element => {
            return {
                [element["bind"]]: element["value"]
            }
        }).reduce((a, b) => Object.assign(a, b), {});

        axios.put('/requests/' + {...requests[index]}.REQUEST_ID, submitdata)
            .then(response => {
                editing = false;
                router.reload();
            })
            .catch(error => {
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
    <H1>Anträge</H1>
    {#if editing}
        <Form onSubmit={submit} onDelete={deletion} onCancel={cancel} newInstance={false} data={formData}></Form>
    {:else}
        {#if requests.length == 0}
            <p>Keine Anträge vorhanden</p>
        {:else}
            <Table on:editData={handleEdit} on:deleteData={handleDeletion} on:decline={handleDecline} on:accept={handleAccept} isRequest={true} bind:data={data}></Table>
        {/if}
        <Button link="/account/requests">Antrag erstellen</Button>
    {/if}
</DashLayout>