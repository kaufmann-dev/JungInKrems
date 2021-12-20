<script>
    import DashLayout from '../../Shared/DashLayout.svelte'
    import Table from '../../Shared/Table.svelte'
    import EventForm from '../../Shared/EventForm.svelte';
    import Form from '../../Shared/Form.svelte';
    import { router } from '@inertiajs/svelte';
    import axios from 'axios';
    import Button from '../../Shared/Button.svelte';

    export let events = [];
    let editing = false;

    let data = events[0];
    let errors = Object.assign({}, data);
    Object.keys(errors).forEach(key => {
      errors[key] = '';
    });

    function handelTableEdit(event){
        let index = event.detail;
        data = events[index];
        editing = true;
    }

    function eventUpdated() {
        editing = false;
        return router.reload();
    }

    function handleTableDelete(event){
        let index = event.detail;
        data = events[index];
        deleteEvent();
    }

    let deleteEvent = () => {
        if(window.confirm('Möchten Sie das Event wirklich löschen?')) {
            router.delete('/events/' + data.EVENT_ID);
            //router.reload();
        }
    }

    let handleFormSubmit = () => {
      axios.put('/events/' + data.EVENT_ID, data)
      .then(response => {
          if (response.status === 200) {
            eventUpdated();
          }
      })
      .catch(error => {
          if (error?.response?.status === 422) {
            for (const [key, value] of Object.entries(errors)) {
              if(error.response.data.errors[key]) {
                errors[key] = error.response.data.errors[key][0];
              } else {
                errors[key] = '';
              }
            }
          }
      });
    }
</script>

<DashLayout>
    <h1>Events</h1>
    {#if editing}
        <!-- <EventForm newEvent={false} bind:data={data} bind:errors=
        {errors} onSubmit={submit} onDelete={deleteEvent}></EventForm> -->
        <Form newEvent={false} bind:data={data} bind:errors={errors} onSubmit={handleFormSubmit} onDelete={deleteEvent}></Form>
    {:else if events.length === 0}
        <p>Keine Events vorhanden</p>
        <Button link="/new" text="Neues Event erstellen"></Button>
    {:else}
        <Table on:deleteData={handleTableDelete} on:editData={handelTableEdit} bind:data={events}></Table>
        <Button link="/new" text="Neues Event erstellen"></Button>
    {/if}
</DashLayout>