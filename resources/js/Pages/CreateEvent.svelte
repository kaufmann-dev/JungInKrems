<script>
    import Layout from "../Shared/Layout.svelte";
    import Form from "../Shared/Form.svelte";
    import { router, Link } from "@inertiajs/svelte";

    $: formData = [{
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
    }, {
      name: "Typ",
      type: "array",
      options: [{
        value: "Freizeit",
        name: "Freizeit"
      },{
        value: "Bildung",
        name: "Bildung"
      }],
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
      type: "text",
      value: "",
      bind: "IMAGE_PATH",
      errorname: "IMAGE_PATH",
      error: ""
    }];

    let submit = () => {
        let submitdata = formData.map(element => {
            if(element["value"] !== "" && element["value"] !== "NaN-NaN-NaNTNaN:NaN") {
                return {
                    [element["bind"]]: element["value"]
                }
            }
        }).reduce((a, b) => Object.assign(a, b), {});

        axios.post('/events', submitdata)
        .then(response => {
            if (response.status === 200) {
                router.get('events');
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

    let cancel = () => {
        router.get('events');
    }
</script>

<Layout>
    <h1 class="tw-mt-6">Event anmelden</h1>
    <p class="tw-text-gray-500">Hier kannst du ein neues Freizeit Event anmelden. <Link href="/account/facilities">Bildungs Event erstellen</Link></p>

    <Form newInstance={true} bind:data={formData} onSubmit={submit} onCancel={cancel} />
</Layout>
