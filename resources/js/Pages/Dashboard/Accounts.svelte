<script>
    import DashLayout from '../../Shared/DashLayout.svelte';
    import Table from '../../Shared/Table.svelte';
    import Form from '../../Shared/Form.svelte';
    export let accounts = [];
    let account = accounts[0];
    let errors = Object.assign({}, account);
    Object.keys(errors).forEach(key => {
        errors[key] = '';
    });

    let editing = false;

    function editAccount(event){
        editing = true;
        let index = event.detail;
        console.log(accounts[index]);
    }

    function deleteAccount(event){
        let index = event.detail;
        console.log(accounts[index]);
    }

    let submit = () => {
        console.log(account);
    }

    let deleteEvent = () => {
        console.log(account);
    }
</script>

<DashLayout>
    <h1>Accounts</h1>
    {#if editing}
        <p>Editing</p>
        <Form bind:data={account} bind:errors={errors} newInstance={false} onSubmit={submit} onDelete={deleteEvent}></Form>
    {:else}
        <Table on:deleteData={deleteAccount} on:editData={editAccount} bind:data={accounts}></Table>
    {/if}
</DashLayout>