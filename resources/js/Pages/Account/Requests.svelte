<script>
    import AccLayout from "../../Shared/AccLayout.svelte";
    import Button from "../../Shared/Button.svelte";
    import RequestListItem from "../../Shared/RequestListItem.svelte";
    import { page, router } from '@inertiajs/svelte';
    import Form from "../../Shared/Form.svelte";
    import H1 from "../../Shared/H1.svelte";
    import Subtitle from "../../Shared/Subtitle.svelte";
    import InfoText from "../../Shared/InfoText.svelte";

    export let requests = [];
    export let facilities = [];

    let data = [
        {
            "name": "Bildungsanstalt",
            "bind": "FACILITY_ID",
            "type": "array",
            "options": facilities.map(facility =>{
                return {
                    "value": facility.facility.FACILITY_ID,
                    "name": facility.facility.NAME
                }
            }),
            "value": "",
            "errorname": "FACILITY_ID",
            error: ""
        },
        {
            "name": "Nachricht",
            "bind": "MESSAGE",
            "type": "text",
            "value": "",
            "errorname": "MESSAGE",
            error: ""
        },
        {
            "name": "Typ",
            "bind": "REQUEST_TYPE",
            "type": "array",
            "options": [
                {
                    "name" : "Freischaltung",
                    "value": "Freischaltung"
                },
                {
                    "name": "Sonstiges",
                    "value": "Sonstiges"
                }
            ],
            "value": "",
            "errorname": "REQUEST_TYPE",
            error: ""
        }
    ]

    let creating = false;

    let submit = () => {
        let submitdata = data.map(element => {
            if(element["value"] !== "" && element["value"] !== "NaN-NaN-NaNTNaN:NaN" && element["value"] !== null) {
            return {
                [element["bind"]]: element["value"]
            }
            }
        }).reduce((a, b) => Object.assign(a, b), {});
        axios.post('/requests', submitdata)
        .then(response => {
            if (response.status === 200) {
                creating = false;
                for (const [key, value] of Object.entries(data)) {
                    data[key]["value"] = "";
                    data[key]["error"] = "";
                }
            }
            router.reload();
        })
        .catch(error => {
            console.log(error);
            if (error?.response?.status === 422) {  
                for (const [key, value] of Object.entries(data)) {
                    if(error.response.data.errors[value["errorname"]]) {
                        data[key]["error"] = error.response.data.errors[value["errorname"]][0];
                    } else {
                        data[key]["error"] = "";
                    }
                }
            }
        });
    }
    let cancel = () => {
        creating = false;
    }
</script>

<AccLayout>
    {#if creating}
        <H1 mb={false}>Neuen Antrag erstellen</H1>
        <Subtitle>Erstelle Sie einen neuen Antrag.</Subtitle>
        <Form newInstance={true} {data} onSubmit={submit} onCancel={cancel}></Form>
    {:else}
        <H1 mb={false}>Meine Anträge</H1>
        <Subtitle>Alle Anträge die Sie erstellt haben.</Subtitle>
        {#if !$page.props.auth.user.IS_EMAIL_VERIFIED}
            <InfoText mb="true" color="light">Sie müssen Ihre E-Mail Adresse bestätigen um einen Antrag erstellen zu könnnen.</InfoText>
            <Button size="small" link="/account/verify"><div class="tw-mx-2">Jetzt bestätigen</div></Button>
        {:else if facilities.length === 0}
            <InfoText mb="true" color="light">Momentan stehen Anträge nur Bildungsanstalten zur Verfügung. Sie verwalten derzeit keine Bildungsanstalten.</InfoText>
            <div></div>
            <Button link="/newfacility">Bildungsanstalt anmelden</Button>
        {:else}
            {#if requests.length === 0}
                <InfoText mb="true" color="light">Sie haben noch keine Anträge erstellt.</InfoText>
            {:else}
                {#each requests as request}
                    <RequestListItem request={request}/>
                {/each}
            {/if}
            <div></div>
            <Button onClick={()=>creating=true}>Neuen Antrag erstellen</Button>
        {/if}
    {/if}
</AccLayout>