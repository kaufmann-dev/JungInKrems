<script>
    import DashLayout from '../../Shared/DashLayout.svelte'
    import Table from '../../Shared/Table.svelte'
    import Form from '../../Shared/Form.svelte';
    import { router } from '@inertiajs/svelte';
    import Button from '../../Shared/Button.svelte';
    import H1 from '../../Shared/H1.svelte';
    import HR from '../../Shared/HR.svelte';
    import InfoText from '../../Shared/InfoText.svelte';

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
        name: "Name",
        type: "text",
        value: {...facilities[index]}.NAME,
        bind: "NAME",
        errorname: "NAME",
        error: ""
    },{
        name: "Beschreibung",
        type: "textarea",
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
        name: "Typ",
        type: "array",
        options: [{
            value: "Kindergarten",
            name: "Kindergarten"
        },{
            value: "Volksschule",
            name: "Volksschule"
        },{
            value: "Sonderschule",
            name: "Sonderschule"
        },{
            value: "Mittelschule",
            name: "Mittelschule"
        },{
            value: "PTS",
            name: "Polytechnische Schule"
        },{
            value: "Berufsschule",
            name: "Berufsschule"
        },{
            value: "BMS",
            name: "Berufsbildene mittlere Schule"
        }, {
            value: "BHS",
            name: "Berufsbildene höhere Schule"
        }, {
            value: "AHS",
            name: "Allgemeinbildende höhere Schule"
        }, {
            value: "Fachhochschule",
            name: "Fachhochschule"
        }, {
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
        type: "file",
        value: '',
        bind: "IMAGE",
        errorname: "IMAGE",
        error: ""
    }];

    function handleTableEdit(event){
        index = event.detail;
        editing = true;
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
            if(element["value"] !== "" && element["value"] !== "NaN-NaN-NaNTNaN:NaN" && element["value"] !== null) {
                return {
                    [element["bind"]]: element["value"]
                }
            }
        }).reduce((a, b) => Object.assign(a, b), {});

        var facilitydata = new FormData();
        for (const [key, value] of Object.entries(submitdata)) {
            facilitydata.append(key, value);
        }

        axios.post('/admin/facilities/' + {...facilities[index]}.FACILITY_ID, facilitydata)
        .then(response => {
            if (response.status === 200) {
                editing = false;
                router.reload();
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

    let handleFormCancel = () => {
        editing = false;
    }
</script>

<DashLayout>
    <H1 mb={false}>Bildungseinrichtungen</H1>
    <HR/>
    {#if editing}
        <Form newInstance={false} data={formData} onSubmit={handleFormEdit} onDelete={deleteFacility} onCancel={handleFormCancel}></Form>
    {:else}
        {#if facilities.length > 0}
            <Table bind:data={data} on:editData={handleTableEdit} on:deleteData={handleTableDelete} ignore={["WEBSITE_URL", "PHONE_NR", "EMAIL", "POSTAL_CODE", "CITY", "ADDRESS", "IMAGE_PATH", "remember_token", 	"created_at", "updated_at"]}></Table>
        {:else}
            <InfoText mb="true" color="light">Keine Einrichtungen vorhanden.</InfoText>
        {/if}
        <div></div>
        <Button link="/newfacility">Neue Einrichtung anmelden</Button>
    {/if}
</DashLayout>