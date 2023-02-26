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
    import Subtitle from "../Shared/Subtitle.svelte";
    import SubmitButton from "../Shared/SubmitButton.svelte";
    import ErrorMessage from "../Shared/ErrorMessage.svelte";
    import H3 from "../Shared/H3.svelte";
    import Table from "../Shared/Table.svelte";

    $: tableData = facility.managers.map(manager =>{
        return {
            Benutzername : manager.NAME,
            "E-Mail" : manager.EMAIL,
        }
    });

    let updating = false;
    let editingManagers = false;
    let creatingEvent = false;

    let managerEmail;
    let managerError = "";

    let managerSubmit = () => {
        axios
            .post("/facilitymanagers", {
                EMAIL: managerEmail,
                FACILITY_ID: facility.FACILITY_ID,
            })
            .then(response => {
                if (response.status === 200) {
                    handleReload();
                }
            })
            .catch(error => {
                console.log(error);
                managerError = error.response.data.message;
            });
    };

    function managerDelete(manager){
        if(!confirm("Möchten Sie diesen Manager wirklich löschen?"))
            return;
        axios
            .post("/facilitymanagers/delete/" + {...facility.managers[manager.detail]}.ACCOUNT_ID, {
                FACILITY_ID: facility.FACILITY_ID,
            })
            .then(response => {
                if (response.status === 200) {
                    handleReload();
                }
            })
            .catch(error => {
                console.log(error);
            });
    }

    let newEventData = [{
        name: "Titel",
        type: "text",
        value: "",
        bind: "TITLE",
        errorname: "TITLE",
        error: ""
    },{
        name: "Beschreibung",
        type: "text",
        value: "",
        bind: "DESCRIPTION",
        errorname: "DESCRIPTION",
        error: ""
    },{
        name: "Typ",
        type: "array",
        options : [
            {value: "Freizeit", name: "Freizeit"},
            {value: "Bildung", name: "Bildung"}
        ],
        value: "",
        bind: "EVENT_TYPE",
        errorname: "EVENT_TYPE",
        error: ""
    }, {
        name: "Startdatum",
        type: "datetime",
        value: "",
        bind: "STARTING_TIME",
        errorname: "STARTING_TIME",
        error: ""
    }, {
        name: "Enddatum",
        type: "datetime",
        value: "",
        bind: "ENDING_TIME",
        errorname: "ENDING_TIME",
        error: ""
    }, {
        name: "Webseite",
        type: "text",
        value: "",
        bind: "WEBSITE_URL",
        errorname: "WEBSITE_URL",
        error: ""
    },{
        name: "E-Mail",
        type: "text",
        value: "",
        bind: "EMAIL",
        errorname: "EMAIL",
        error: ""
    },{
        name: "Telefonnummer",
        type: "text",
        value: "",
        bind: "PHONE_NR",
        errorname: "PHONE_NR",
        error: ""
    },{
        name: "Postleitzahl",
        type: "text",
        value: "",
        bind: "POSTAL_CODE",
        errorname: "POSTAL_CODE",
        error: ""
    },{
        name: "Stadt",
        type: "text",
        value: "",
        bind: "CITY",
        errorname: "CITY",
        error: ""
    },{
        name: "Adresse",
        type: "text",
        value: "",
        bind: "ADDRESS",
        errorname: "ADDRESS",
        error: ""
    },{
        name: "Bild",
        type: "file",
        value: "",
        bind: "IMAGE",
        errorname: "IMAGE",
        error: ""
    }];

    function handleReload() {
        cancel();
        router.reload();
    }

    function cancel() {
        updating = false;
        editingManagers = false;
        creatingEvent = false;
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
                { name: "Kindergarten", value: "Kindergarten" },
                { name: "Volksschule", value: "Volksschule" },
                { name: "Sonderschule", value: "Sonderschule" },
                { name: "Mittelschule", value: "Mittelschule" },
                { name: "Polytechnische Schule", value: "PTS" },
                { name: "Berufsschule", value: "Berufsschule" },
                { name: "Berufsbildende mittlere Schule", value: "BMS" },
                { name: "Berufsbildende höhere Schule", value: "BHS" },
                { name: "Allgemeinbildende höhere Schule", value: "AHS" },
                { name: "Fachhochschule", value: "Fachhochschule" },
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
            bind: "IMAGE",
            type: "file",
            value: '',
            errorname: "IMAGE",
            error: ""
        }
    ];

    let submitNewEvent = () => {
        let submitdata = newEventData.map(element => {
            if(element["value"] !== "" && element["value"] !== "NaN-NaN-NaNTNaN:NaN" && element["value"] !== null) {
                return {
                    [element["bind"]]: element["value"]
                }
            }
        }).reduce((a, b) => Object.assign(a, b), {});

        let formdata = new FormData();
        for (const [key, value] of Object.entries(submitdata)) {
            formdata.append(key, value);
        }
        formdata.append("FACILITY_ID", facility.FACILITY_ID);
        formdata.append("ACCOUNT_ID", $page.props.auth.user?.ACCOUNT_ID);

        axios.post('/events', formdata)
            .then(response => {
                if (response.status === 200) {
                    handleReload();
                }
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

    let deleteFacility = () => {
        if(window.confirm("Möchten Sie die Einrichtung wirklich löschen?")) {
            updating = true;
            axios.post('/facilities/delete/' + facility.FACILITY_ID);
            router.get('/facilities');
        }
    }

    let submit = () => {
        let submitdata = data.map(element => {
            if(element["value"] !== "" && element["value"] !== "NaN-NaN-NaNTNaN:NaN" && element["value"] !== null) {
                return {
                    [element["bind"]]: element["value"]
                }
            }
        }).reduce((a, b) => Object.assign(a, b), {});

        let formdata = new FormData();
        for (const [key, value] of Object.entries(submitdata)) {
            formdata.append(key, value);
        }

        axios.post('/facilities/' + facility.FACILITY_ID, formdata)
            .then(response => {
                if (response.status === 200) {
                    handleReload();
                }
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
</script>

<Layout>
    {#if updating}
        <Form newInstance={false} {data} onSubmit={submit} onCancel={cancel} onDelete={deleteFacility}></Form>
    {:else if editingManagers}
            <div class="lg:tw-flex lg:tw-flex-row lg:tw-gap-3">
                <div class="lg:tw-flex-1">
                    <H1 mb={false}>Verantwortliche</H1>
                    <Subtitle>Verantwortliche können Ihre Einrichtung verwalten.</Subtitle>
                    <Table onlyDelete={true} on:deleteData={managerDelete} data={tableData}></Table>
                </div>
                <div class="lg:tw-flex-1">
                    <H1 mb={false}>Hinzufügen</H1>
                    <Subtitle>Füge neue Verantwortliche für deine Bildungsanstalt hinzu.</Subtitle>
                    <form on:submit|preventDefault={managerSubmit} class="tw-w-full tw-flex tw-flex-col tw-items-center">
                        <div class="tw-w-full tw-flex tw-flex-col tw-items-center">
                        <input
                            autocomplete="off"
                            placeholder="E-Mail"
                            id="bru" type="text"
                            class="tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm"
                            bind:value={managerEmail}
                        >
                        <ErrorMessage>{managerError}</ErrorMessage>
                        </div>
                        <div class="tw-flex tw-gap-2 tw-mt-2">
                            <SubmitButton type='primary'>Hinzufügen</SubmitButton>
                            <SubmitButton onClick={cancel} type='light'>Abbrechen</SubmitButton>
                        </div>
                    </form>
                </div>
            </div>
    {:else if creatingEvent}
        <H1 mb={false}>Event anmelden</H1>
        <Subtitle>Melden Sie ein Event für {facility.NAME} an.</Subtitle>
        <Form newInstance={true} data={newEventData} onSubmit={submitNewEvent} onCancel={cancel}></Form>
    {:else}
        <div class="tw-grid tw-gap-4 md:tw-grid-cols-2 tw-my-8">
            <div>
                <H1 mt={false}>{facility.NAME}</H1>
                <InfoText color="blue">{facility.FACILITY_TYPE}</InfoText>
                <BookmarkButton checkId={facility.FACILITY_ID}></BookmarkButton>
                <div class="tw-text-lg tw-grid tw-gap-2 tw-mt-4">
                    <div class="tw-flex">
                        <i class="tw-mx-3 tw-text-blue-500 bi bi-geo-alt-fill"></i> <span>{facility.ADDRESS}, {facility.POSTAL_CODE} {facility.CITY}</span>
                    </div>
                    <div>
                        <i class="tw-mx-3 tw-text-blue-500 bi bi-telephone-fill"></i> <span>{facility.PHONE_NR}</span>
                    </div>
                    <div>
                        <i class="tw-mx-3 tw-text-blue-500 bi bi-link-45deg"></i> <a href="{facility.WEBSITE_URL}" class="tw-underline">{facility.WEBSITE_URL}</a>
                    </div>
                    <div>
                        <i class="tw-mx-3 tw-text-blue-500 bi bi-envelope-fill"></i> <span>{facility.EMAIL}</span>
                    </div>
                </div>
            </div>
            <div>
                <img class="tw-object-cover tw-shadow-lg tw-w-full tw-rounded-xl" src="/images/uploads/{facility.IMAGE_PATH}" alt="{facility.NAME}">
            </div>
        </div>
        {#if facility.managers.map(manager => manager.ACCOUNT_ID).includes($page.props.auth.user?.ACCOUNT_ID)}
            <div class="tw-flex tw-flex-col sm:tw-flex-row sm:tw-justify-end tw-gap-2 tw-mb-8">
                <Button onClick={()=>updating=true}>Bearbeiten</Button>
                <Button onClick={()=>editingManagers=true}>Verwalter verwalten</Button>
                <Button onClick={()=>creatingEvent=true}>Event anmelden</Button>
            </div>
        {/if}
        <H3>Beschreibung</H3>
        <span class="tw-mb-4 tw-block">{facility.DESCRIPTION}</span>
        {#if facility.events?.length > 0}
            <H3>Events der <span class="tw-text-yellow-400">{facility.NAME}</span></H3>
            {#each facility.events as event}
                <EventListItem event={event}></EventListItem>
            {/each}
        {/if}
    {/if}
</Layout>