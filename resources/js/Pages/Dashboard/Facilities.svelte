<script>
    import DashLayout from '../../Shared/DashLayout.svelte'
    import Table from '../../Shared/Table.svelte'
    import Form from '../../Shared/Form.svelte';
    import { router } from '@inertiajs/svelte';
    import axios from 'axios';
    import Button from '../../Shared/Button.svelte';
    import H1 from '../../Shared/H1.svelte';

    export let facilities;
    let editing = false;
    let index = 0;

    $: data = facilities.map(facility =>{
        return {
            ID : facility.FACILITY_ID,
            Name : facility.NAME,
            Beschreibung : facility.DESCRIPTION,
            Verifiziert : facility.IS_CITY_VERIFIED ? "Ja" : "Nein",
            Bildungstyp : facility.FACILITY_TYPE,
        }
    })

    $: formData = [{
        name: "ID",
        type: "text",
        value: {...facilities[index]}.FACILITY_ID,
        bind: "FACILITY_ID",
        errorname: "FACILITY_ID",
        error: ""
    },{
        name: "Name",
        type: "text",
        value: {...facilities[index]}.NAME,
        bind: "NAME",
        errorname: "NAME",
        error: ""
    },{
        name: "Beschreibung",
        type: "text",
        value: {...facilities[index]}.DESCRIPTION,
        bind: "DESCRIPTION",
        errorname: "DESCRIPTION",
        error: ""
    },{
        name: "Verifiziert",
        type: "array",
        options: [{
            value: false,
            name: "Nein"
        },{
            value: true,
            name: "Ja"
        }],
        value: {...facilities[index]}.IS_CITY_VERIFIED,
        bind: "IS_CITY_VERIFIED",
        errorname: "IS_CITY_VERIFIED",
        error: ""
    },{
        name: "Bildungstyp",
        type: "array",
        options: [{
            value: "BHS",
            name: "Kindergarten"
        },{
            value: "Gymnasium",
            name: "Gymnasium"
        },{
            value: "Realschule",
            name: "Realschule"
        },{
            value: "Hauptschule",
            name: "Hauptschule"
        },{
            value: "Grundschule",
            name: "Grundschule"
        },{
            value: "Kindergarten",
            name: "Kindergarten"
        },{
            value: "Universität",
            name: "Universität"
        }],
        value: {...facilities[index]}.FACILITY_TYPE,
        bind: "FACILITY_TYPE",
        errorname: "FACILITY_TYPE",
        error: ""
    },{
        name: "Website",
        type: "text",
        value: {...facilities[index]}.WEBSITE_URL,
        bind: "WEBSITE_URL",
        errorname: "WEBSITE_URL",
        error: ""
    },{
        name: "Telefonnummer",
        type: "text",
        value: {...facilities[index]}.PHONE_NR,
        bind: "PHONE_NR",
        errorname: "PHONE_NR",
        error: ""
    },{
        name: "E-Mail",
        type: "text",
        value: {...facilities[index]}.EMAIL,
        bind: "EMAIL",
        errorname: "EMAIL",
        error: ""
    },{
        name: "PLZ",
        type: "text",
        value: {...facilities[index]}.POSTAL_CODE,
        bind: "POSTAL_CODE",
        errorname: "POSTAL_CODE",
        error: ""
    },{
        name: "Stadt",
        type: "text",
        value: {...facilities[index]}.CITY,
        bind: "CITY",
        errorname: "CITY",
        error: ""
    },{
        name: "Adresse",
        type: "text",
        value: {...facilities[index]}.ADDRESS,
        bind: "ADDRESS",
        errorname: "ADDRESS",
        error: ""
    },{
        name: "Bild",
        type: "text",
        value: {...facilities[index]}.IMAGE_PATH,
        bind: "IMAGE_PATH",
        errorname: "IMAGE_PATH",
        error: ""
    }];

    function handleTableEdit(event){
        index = event.detail;
        editing = true;
    }

    function facilityUpdated() {
        handleFormCancel();
        router.reload();
    }

    function handleTableDelete(event){

        if(!window.confirm('Möchten Sie die Einrichtung wirklich löschen?'))
            return;
        axios.post('/facilities/delete/' + {...facilities[event.detail]}.FACILITY_ID);
        router.reload();
    }

    let deleteFacility = () => {
        if(!window.confirm('Möchten Sie die Einrichtung wirklich löschen?'))
            return;
        axios.post('/facilities/delete' + {...facilities[index]}.FACILITY_ID);
        router.reload();
    }

    let handleFormEdit = () => {
        let submitdata = formData.map(element => {
            return {
                [element["bind"]]: element["value"]
            }
        }).reduce((a, b) => Object.assign(a, b), {});

        axios.post('/admin/facilities/' + {...facilities[index]}.FACILITY_ID, submitdata)
        .then(response => {
            if (response.status === 200) {
                editing = false;
                router.reload();
            }
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

    let handleFormCancel = () => {
        editing = false;
    }
</script>

<DashLayout>
    <H1>Bildungseinrichtungen</H1>
    {#if editing}
        <Form newInstance={false} data={formData} onSubmit={handleFormEdit} onDelete={deleteFacility} onCancel={handleFormCancel}></Form>
    {:else}
        {#if facilities.length > 0}
            <Table bind:data={data} on:editData={handleTableEdit} on:deleteData={handleTableDelete} ignore={["WEBSITE_URL", "PHONE_NR", "EMAIL", "POSTAL_CODE", "CITY", "ADDRESS", "IMAGE_PATH", "remember_token", 	"created_at", "updated_at"]}></Table>
        {:else}
            <p>Keine Einrichtungen vorhanden</p>
        {/if}
        <Button link="/newfacility">Neue Einrichtung anmelden</Button>
    {/if}
</DashLayout>