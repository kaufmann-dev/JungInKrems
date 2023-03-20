<script>
    import { router } from '@inertiajs/svelte';
    import Button from '../Shared/Button.svelte';
    import Layout from '../Shared/Layout.svelte';
    import CenterDiv from '../Shared/CenterDiv.svelte';
    import H1 from '../Shared/H1.svelte';

    let loggedOut = false;

    axios.post('logout', {})
    .then(response => {
        if (response.status === 200) {
            loggedOut = true;
            router.reload();
        }
    });
</script>

<Layout>
    <CenterDiv>
        <div class="tw-text-center">
            {#if loggedOut}
                <H1 mb={false}>Sie wurden abgemeldet.</H1>
            {:else}
                <H1 mb={false}>Sie sind bereits abgemeldet.</H1>
            {/if}
            <Button link="/login">Anmelden</Button>
        </div>
    </CenterDiv>
</Layout>