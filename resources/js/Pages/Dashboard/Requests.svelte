<script>
    import Button from '../../Shared/Button.svelte';
    import DashLayout from '../../Shared/DashLayout.svelte'
    import Table from '../../Shared/Table.svelte'
    export let requests = [];
</script>

<DashLayout>
    <h1>Requests</h1>
    <Table bind:data={requests}></Table>
    <Button link="/dashboard/requests/create">Create Request</Button>
</DashLayout>