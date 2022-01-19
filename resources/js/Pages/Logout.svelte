<script>
    import { onMount } from 'svelte';
    import axios from 'axios';
    import { page, router } from '@inertiajs/svelte';
    import Button from '../Shared/Button.svelte';
    import Layout from '../Shared/Layout.svelte';
    import CenterDiv from '../Shared/CenterDiv.svelte';

    let loggedOut = false;

    console.log( $page.props.csrfToken );

    axios.post('logout', {})
    .then(response => {
        if (response.status === 200) {
            loggedOut = true;
            router.reload();
            //window.history.back();
        }
    })
    .catch(error => {
        console.log(error);
    });

    /* fetch('logout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            _token: $page.props.csrfToken
        })
    })
        .then(response => {
            if (response.ok) {
                isLoggedOut = true;
            }
        })
        .catch(error => {
            console.log(error);
        }); */
</script>

<Layout>
    <CenterDiv>
        <div class="tw-text-center">
            {#if loggedOut}
                <h1 class="tw-mb-6">Sie wurden abgemeldet.</h1>
            {:else}
                <h1 class="tw-mb-6">Sie sind bereits abgemeldet.</h1>
            {/if}
            <Button link="/login">Anmelden</Button>
        </div>
    </CenterDiv>
</Layout>