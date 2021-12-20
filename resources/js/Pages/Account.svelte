<script>
    import Layout from "../Shared/Layout.svelte";
    import { page } from '@inertiajs/svelte';
    let user = $page.props.auth.user;
</script>

<Layout>
    <h1>Account</h1>
    {#if user}
        <p>{user.NAME}</p>
    {/if}
</Layout>