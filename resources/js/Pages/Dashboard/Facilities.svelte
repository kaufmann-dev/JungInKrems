<script>
    import DashLayout from '../../Shared/DashLayout.svelte'
    import Table from '../../Shared/Table.svelte'
    import Form from '../../Shared/Form.svelte';
    import { router } from '@inertiajs/svelte';
    import axios from 'axios';
    import Button from '../../Shared/Button.svelte';

    export let facilities;
    let editing = false;
    let creating = false;

    let data = {...facilities[0]};
    let errors = Object.assign({}, data);
    Object.keys(errors).forEach(key => errors[key] = '');
    Object.keys(data).forEach(key => data[key] = '');

    function handleTableEdit(event){
        let index = event.detail;
        data = {...facilities[index]};
        editing = true;
    }

    function facilityUpdated() {
        handleFormCancel();
        return router.reload();
    }

    function handleTableDelete(event){
        let index = event.detail;
        data = {...facilities[index]};
        deleteFacility();
    }

    let deleteFacility = () => {
        if(window.confirm('Möchten Sie die Einrichtung wirklich löschen?')) {
            router.delete('/facilities/' + data.FACILITY_ID);
        }
    }

    let handleFormEdit = () => {
        axios.put('/facilities/' + data.FACILITY_ID, data)
        .then(response => {
            if (response.status === 200) {
                facilityUpdated();
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

    let handleFormNew = () => {
        axios.post('/facilities', data)
        .then(response => {
            if (response.status === 200) {
                facilityUpdated();
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

    let handleFormCancel = () => {
        Object.keys(data).forEach(key => data[key] = '');
        Object.keys(errors).forEach(key => errors[key] = '');
        editing = false;
        creating = false;
    }
</script>

<DashLayout>
    <h1>Facilities</h1>
    {#if editing}
        <Form newInstance={false} bind:data={data} bind:errors={errors} onSubmit={handleFormEdit} onDelete={deleteFacility} onCancel={handleFormCancel}></Form>
    {:else if creating}
        <Form newInstance={true} bind:data={data} bind:errors={errors} onsubmit={handleFormNew} onCancel={handleFormCancel}></Form>
    {:else}
        {#if facilities.length > 0}
            <Table bind:data={facilities} on:editData={handleTableEdit} on:deleteData={handleTableDelete}></Table>
        {:else}
            <p>Keine Einrichtungen vorhanden</p>
        {/if}
        <div on:click={() => creating = true}>
            <Button>Neue Einrichtung anlegen</Button>
        </div>
    {/if}
</DashLayout>