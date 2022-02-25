<script>
    import Layout from "../Shared/Layout.svelte";
    import Form from "../Shared/Form.svelte";
    import { router, Link } from "@inertiajs/svelte";
    import H1 from "../Shared/H1.svelte";

    $: formData = [{
        name: "Name",
        type: "text",
        value: "",
        bind: "NAME",
        errorname: "NAME",
        error: ""
    },{
        name: "Beschreibung",
        type: "text",
        value: "",
        bind: "DESCRIPTION",
        errorname: "DESCRIPTION",
        error: ""
    },{
        name: "Bildungstyp",
        type: "array",
        options: [{
            value: "Kindergarten",
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
        value: "",
        bind: "FACILITY_TYPE",
        errorname: "FACILITY_TYPE",
        error: ""
    },{
        name: "Website",
        type: "text",
        value: "",
        bind: "WEBSITE_URL",
        errorname: "WEBSITE_URL",
        error: ""
    },{
        name: "Telefonnummer",
        type: "text",
        value: "",
        bind: "PHONE_NR",
        errorname: "PHONE_NR",
        error: ""
    },{
        name: "E-Mail",
        type: "text",
        value: "",
        bind: "EMAIL",
        errorname: "EMAIL",
        error: ""
    },{
        name: "PLZ",
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

    let submit = () => {
        let submitdata = formData.map(element => {
            if(element["value"] !== "") {
                return {
                    [element["bind"]]: element["value"]
                }
            }
        }).reduce((a, b) => Object.assign(a, b), {});

        var cooldata = new FormData();
        for (const [key, value] of Object.entries(submitdata)) {
            cooldata.append(key, value);
        }

        axios.post('/facilities', cooldata)
        .then(response => {
            if (response.status === 200) {
                router.get('facilities');
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
            console.log(error);
        });
    }

    let cancel = () => {
        router.get('facilities');
    }

</script>

<Layout>
    <H1 mb={false}>Bildungsanstalt anmelden</H1>
    <span class="tw-text-gray-500 tw-mb-4">Hier kannst du eine neue Bildungsanstalt anmelden.</span>
    <Form newInstance={true} bind:data={formData} onSubmit={submit} onCancel={cancel} />
</Layout>
