<script>
    import DashLayout from '../../Shared/DashLayout.svelte'
    import Table from '../../Shared/Table.svelte'
    import Form from '../../Shared/Form.svelte';
    import { router } from '@inertiajs/svelte';
    import axios from 'axios';
    import Button from '../../Shared/Button.svelte';
    import H1 from '../../Shared/H1.svelte';

    export let events = [];
    let index = 0;
    let editing = false;

    $: data = events.map(event =>{
      return {
        ID : event.EVENT_ID,
        Titel : event.TITLE,
        Beschreibung : event.DESCRIPTION,
        Typ : event.EVENT_TYPE,
      }
    })

    $: formData = [{
      name: "ID",
      type: "text",
      value: {...events[index]}.EVENT_ID,
      bind: "EVENT_ID",
      errorname: "EVENT_ID",
      error: ""
    }, {
      name: "Titel",
      type: "text",
      value: {...events[index]}.TITLE,
      bind: "TITLE",
      errorname: "TITLE",
      error: ""
    }, {
      name: "Beschreibung",
      type: "text",
      value: {...events[index]}.DESCRIPTION,
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
      value: {...events[index]}.EVENT_TYPE,
      bind: "EVENT_TYPE",
      errorname: "EVENT_TYPE",
      error: ""
    }, {
      name: "Startdatum",
      type: "datetime",
      value: {...events[index]}.STARTING_TIME,
      bind: "STARTING_TIME",
      errorname: "STARTING_TIME",
      error: ""
    }, {
      name: "Enddatum",
      type: "datetime",
      value: {...events[index]}.ENDING_TIME,
      bind: "ENDING_TIME",
      errorname: "ENDING_TIME",
      error: ""
    }, {
      name: "Webseite",
      type: "text",
      value: {...events[index]}.WEBSITE_URL,
      bind: "WEBSITE_URL",
      errorname: "WEBSITE_URL",
      error: ""
    },{
      name: "E-Mail",
      type: "text",
      value: {...events[index]}.EMAIL,
      bind: "EMAIL",
      errorname: "EMAIL",
      error: ""
    },{
        name: "Telefonnummer",
        type: "text",
        value: {...events[index]}.PHONE_NR,
        bind: "PHONE_NR",
        errorname: "PHONE_NR",
        error: ""
    },{
        name: "Postleitzahl",
        type: "text",
        value: {...events[index]}.POSTAL_CODE,
        bind: "POSTAL_CODE",
        errorname: "POSTAL_CODE",
        error: ""
    },{
      name: "Stadt",
      type: "text",
      value: {...events[index]}.CITY,
      bind: "CITY",
      errorname: "CITY",
      error: ""
    },{
      name: "Adresse",
      type: "text",
      value: {...events[index]}.ADDRESS,
      bind: "ADDRESS",
      errorname: "ADDRESS",
      error: ""
    },{
      name: "Bild",
      type: "text",
      value: {...events[index]}.IMAGE_PATH,
      bind: "IMAGE_PATH",
      errorname: "IMAGE_PATH",
      error: ""
    }]

    function handleTableEdit(event){
        index = event.detail;
        editing = true;
    }

    function eventUpdated() {
        editing = false;
        router.reload();
    }

    function handleTableDelete(event){
      if(!window.confirm('Möchten Sie die Einrichtung wirklich löschen?'))
        return;
      axios.delete('/events/' + {...events[event.detail]}.EVENT_ID);
      router.reload();
    }

    let deleteEvent = () => {
      if(!window.confirm('Möchten Sie die Einrichtung wirklich löschen?'))
        return;
      axios.delete('/events/' + {...events[index]}.EVENT_ID);
      router.reload();
    }

    let handleFormSubmit = () => {
      let submitdata = formData.map(element => {
            return {
                [element["bind"]]: element["value"]
            }
        }).reduce((a, b) => Object.assign(a, b), {});

      axios.put('/events/' + {...events[index]}.EVENT_ID, submitdata)
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

    let cancel = () => {
      editing = false;
    }
</script>

<DashLayout>
    <H1>Events</H1>
    {#if editing}
        <Form newInstance={false} data={formData} onSubmit={handleFormSubmit} onDelete={deleteEvent} onCancel={cancel}></Form>
    {:else if events.length === 0}
        <p>Keine Events vorhanden</p>
        <Button link="/newevent">Neues Event erstellen</Button>
    {:else}
        <Table on:deleteData={handleTableDelete} on:editData={handleTableEdit} {data} ignore={["ACCOUNT_ID", "FACILITY_ID", "STARTING_TIME", "ENDING_TIME", "WEBSITE_URL", "PHONE_NR", "EMAIL", "POSTAL_CODE", "CITY", "ADDRESS", "IMAGE_PATH", "remember_token", "created_at", "updated_at"]}></Table>
        <Button link="/newevent">Neues Event erstellen</Button>
    {/if}
</DashLayout>