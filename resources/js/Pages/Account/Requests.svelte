<script>
    import AccLayout from "../../Shared/AccLayout.svelte";
    import Button from "../../Shared/Button.svelte";
    import RequestListItem from "../../Shared/RequestListItem.svelte";
    import { page, router } from '@inertiajs/svelte';
    import Form from "../../Shared/Form.svelte";
    import H1 from "../../Shared/H1.svelte";
    import Subtitle from "../../Shared/Subtitle.svelte";

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
            if (error?.response?.status === 422) {  
                /* for (const [key, value] of Object.entries(error.response.data.errors)) {
                    data.forEach(element => {
                        if(element["errorname"] === key) {
                            element["error"] = value[0];
                        } else {
                            element["error"] = "";
                        }
                    });
                } */
                for (const [key, value] of Object.entries(data)) {
                    if(error.response.data.errors[value["errorname"]]) {
                        data[key]["error"] = error.response.data.errors[value["errorname"]][0];
                    } else {
                        data[key]["error"] = "";
                    }
                }
            }
            console.log(error);
        });
    }
    let cancel = () => {
        creating = false;
    }
</script>

<AccLayout>
    {#if creating}
        <H1 class="tw-mt-6">Neuen Antrag erstellen</H1>
        <Subtitle>Erstelle Sie einen neuen Antrag.</Subtitle>
        <Form newInstance={true} {data} onSubmit={submit} onCancel={cancel}></Form>
    {:else}
        <H1 class="tw-mt-6">Meine Anträge</H1>
        <Subtitle>Alle Anträge die Sie erstellt haben.</Subtitle>
        {#if !$page.props.auth.user.IS_EMAIL_VERIFIED}
            <span class="tw-mb-4 tw-block">Sie müssen Ihre E-Mail Adresse bestätigen um einen Antrag erstellen zu könnnen.</span>
            <Button link="/account/verify">Jetzt bestätigen</Button>
        {:else if facilities.length === 0}
            <span class="tw-mb-4 tw-block">Momentan stehen Anträge nur Bildungsanstalten zur Verfügung. Sie verwalten derzeit keine Bildungsanstalten.</span>
            <Button link="/newfacility">Bildungsanstalt anmelden</Button>
        {:else}
            {#if requests.length === 0}
                <span class="tw-mb-4 tw-block">Sie haben noch keine Anträge erstellt.</span>
            {:else}
                {#each requests as request}
                    <RequestListItem request={request}/>
                {/each}
            {/if}
            <Button onClick={()=>creating=true}>Neuen Antrag erstellen</Button>
        {/if}
    {/if}
</AccLayout>

<!-- <div class="tw-fixed tw-top-0 tw-left-0 tw-w-full tw-h-full tw-bg-black tw-opacity-50 tw-flex tw-justify-center tw-items-center">
    <div class="tw-bg-white tw-w-1/2 tw-p-6 tw-rounded">
        <h1 class="tw-text-2xl tw-mb-6">Neuen Antrag erstellen</h1>
        <p class="tw-mb-6">Bitte wählen Sie eine Bildungseinrichtung aus.</p>
        <div class="tw-flex tw-flex-wrap tw-justify-center">
            {#each $page.props.facilities as facility}
                <div class="tw-m-2">
                    <Button link="/newfacility/{facility.id}">{facility.name}</Button>
                </div>
            {/each}
        </div>
        <div class="tw-mt-6 tw-flex tw-justify-end">
            <Button on:click={()=>creating=false}>Abbrechen</Button>
        </div>
    </div>
</div> -->