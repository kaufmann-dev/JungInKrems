<script>
    export let facility;
    import Layout from "../Shared/Layout.svelte";
    import InfoText from "../Shared/InfoText.svelte";
    import BookmarkButton from "../Shared/BookmarkButton.svelte";
    import { router, page } from "@inertiajs/svelte";
    import Form from "../Shared/Form.svelte";
    import Button from "../Shared/Button.svelte";
    import EventListItem from "../Shared/EventListItem.svelte";
    import H1 from "../Shared/H1.svelte";

    let updating = false;

    function facilityUpdated() {
        updating = false;
        router.reload();
    }

    function cancel() {
        facilityUpdated();
    }

    let data = [
        {
            name: "Titel",
            bind: "NAME",
            type: "text",
            value: facility.NAME,
            errorname: "NAME",
            error: ""
        },
        {
            name: "Beschreibung",
            bind: "DESCRIPTION",
            type: "text",
            value: facility.DESCRIPTION,
            errorname: "DESCRIPTION",
            error: ""
        },
        {
            name: "Typ",
            bind: "FACILITY_TYPE",
            type: "array",
            options: [
                { name: "BHS", value: "BHS" },
                { name: "Gymnasium", value: "Gymnasium" },
                { name: "Realschule", value: "Realschule" },
                { name: "Hauptschule", value: "Hauptschule" },
                { name: "Grundschule", value: "Grundschule" },
                { name: "Kindergarten", value: "Kindergarten" },
                { name: "Universität", value: "Universität" }
            ],
            value: facility.FACILITY_TYPE,
            errorname: "FACILITY_TYPE",
            error: ""
        },
        {
            name: "Adresse",
            bind: "ADDRESS",
            type: "text",
            value: facility.ADDRESS,
            errorname: "ADDRESS",
            error: ""
        },
        {
            name: "PLZ",
            bind: "POSTAL_CODE",
            type: "text",
            value: facility.POSTAL_CODE,
            errorname: "POSTAL_CODE",
            error: ""
        },
        {
            name: "Stadt",
            bind: "CITY",
            type: "text",
            value: facility.CITY,
            errorname: "CITY",
            error: ""
        },
        {
            name: "Telefonnummer",
            bind: "PHONE_NR",
            type: "text",
            value: facility.PHONE_NR,
            errorname: "PHONE_NR",
            error: ""
        },
        {
            name: "E-Mail",
            bind: "EMAIL",
            type: "text",
            value: facility.EMAIL,
            errorname: "EMAIL",
            error: ""
        },
        {
            name: "Website",
            bind: "WEBSITE_URL",
            type: "text",
            value: facility.WEBSITE_URL,
            errorname: "WEBSITE_URL",
            error: ""
        },
        {
            name: "Bild",
            bind: "IMAGE_PATH",
            type: "text",
            value: facility.IMAGE_PATH,
            errorname: "IMAGE_PATH",
            error: ""
        }
    ];

    let deleteFacility = () => {
        if(window.confirm("Möchten Sie die Einrichtung wirklich löschen?")) {
            updating = true;
            axios.delete('/facilities/' + facility.FACILITY_ID);
            router.get('/facilities');
        }
    }

    let submit = () => {
        let submitdata = data.map(element => {
            return {
                [element["bind"]]: element["value"]
            }
        }).reduce((a, b) => Object.assign(a, b), {});

        axios.put('/facilities/' + facility.FACILITY_ID, submitdata)
            .then(response => {
                if (response.status === 200) {
                    facilityUpdated();
                }
            })
            .catch(error => {
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
</script>

<Layout>
    {#if updating}
        <Form newInstance={false} {data} onSubmit={submit} onCancel={cancel} onDelete={deleteFacility}></Form>
    {:else}
        <div class="tw-grid tw-gap-4 md:tw-grid-cols-2 tw-my-8">
            <div>
                <H1 mt={false}>{facility.NAME}</H1>
                <InfoText color="blue">{facility.FACILITY_TYPE}</InfoText>
                <BookmarkButton checkId={facility.FACILITY_ID}></BookmarkButton>
                <div class="tw-text-xl tw-grid tw-gap-2 tw-mt-4">
                    <div class="tw-flex">
                        <i class="tw-mx-3 tw-text-blue-500 bi bi-geo-alt-fill"></i> <span>{facility.ADDRESS}, {facility.POSTAL_CODE} {facility.CITY}</span>
                    </div>
                    <div>
                        <i class="tw-mx-3 tw-text-blue-500 bi bi-telephone-fill"></i> <span>{facility.PHONE_NR}</span>
                    </div>
                    <div>
                        <i class="tw-mx-3 tw-text-blue-500 bi bi-link-45deg"></i> <a href="{facility.WEBSITE_URL}">{facility.WEBSITE_URL}</a>
                    </div>
                    <div>
                        <i class="tw-mx-3 tw-text-blue-500 bi bi-envelope-fill"></i> <span>{facility.EMAIL}</span>
                    </div>
                </div>
            </div>
            <div>
                <img class="tw-object-cover tw-h-full tw-w-full tw-rounded-xl" src="{facility.IMAGE_PATH}" alt="{facility.NAME}">
            </div>
        </div>
        {#if $page.props.auth.user?.ACCOUNT_ID in facility.managers.map(account => account.ACCOUNT_ID)}
            <div class="tw-flex tw-justify-end tw-gap-4">
                <Button onClick={()=>updating=true}>Bearbeiten</Button>
                <Button onClick={()=>console.log("Verwalter hinzufügen")}>Verwalter hinzufügen</Button>
                <Button onClick={()=>console.log("Event anmelden")}>Event anmelden</Button>
            </div>
        {/if}
        <h3>Beschreibung</h3>
        <p>{facility.DESCRIPTION}</p>
        {#if facility.events?.length > 0}
            <h3>Events der <span class="tw-text-yellow-400">{facility.NAME}</span></h3>
            {#each facility.events as event}
                <EventListItem event={event}></EventListItem>
            {/each}
        {/if}
    {/if}
</Layout>