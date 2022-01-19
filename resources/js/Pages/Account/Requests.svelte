<script>
    import AccLayout from "../../Shared/AccLayout.svelte";
    import Button from "../../Shared/Button.svelte";
    import RequestListItem from "../../Shared/RequestListItem.svelte";
    import { page, router } from '@inertiajs/svelte';
    import Form from "../../Shared/Form.svelte";
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
            return {
                [element["bind"]]: element["value"]
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
        });
    }
    let cancel = () => {
        creating = false;
    }
</script>

<AccLayout>
    {#if creating}
        <h1 class="tw-mt-6">Neuen Antrag erstellen</h1>
        <p class="tw-text-gray-500">Erstelle Sie einen neuen Antrag.</p>
        <Form newInstance={true} {data} onSubmit={submit} onCancel={cancel}></Form>
    {:else}
        <h1 class="tw-mt-6">Meine Anträge</h1>
        <p class="tw-text-gray-500">Alle Anträge die sie erstellt haben.</p>
        {#if !$page.props.auth.user.IS_EMAIL_VERIFIED}
            <hr>
            <p>Sie müssen Ihre E-Mail Adresse bestätigen um einen Antrag erstellen zu könnnen.</p>
            <Button link="/account/verify">Jetzt bestätigen</Button>
        {:else}
            {#if requests.length === 0}
                <hr>
                <p>Sie haben noch keine Anträge erstellt.</p>
            {:else}
                {#each requests as request}
                    <RequestListItem request={request}/>
                {/each}
            {/if}
            <div class="mt-3" on:click={()=>creating=true}>
                <Button>Neuen Antrag erstellen</Button>
            </div>
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