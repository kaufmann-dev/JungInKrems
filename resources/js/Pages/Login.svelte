<script>
    import { page, router, Link } from '@inertiajs/svelte';
    import Layout from '../Shared/Layout.svelte';
    import Button from '../Shared/Button.svelte';
    import SubmitButton from '../Shared/SubmitButton.svelte';
    import axios from 'axios';
    import CenterDiv from '../Shared/CenterDiv.svelte';

    let loggedIn = false;

    let credentials = {
        email: '',
        password: '',
        remember: false
    };

    let errors = {
        email: '',
        password: '',
    };

    function submit() {
        axios.post('/login', credentials)
        .then(response => {
            if (response.status === 200) {
                loggedIn = true;
                router.reload();
            }
        })
        .catch(error => {
            errors.email = '';
            errors.password = '';
            if(error.response.data.email) {
                errors.email = error.response.data.email;
            }
            if(error.response.data.password) {
                errors.password = error.response.data.password;
            }
        });
        /* fetch('login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                _token: $page.props.csrfToken,
                email: credentials.email,
                password: credentials.password,
            })
        })
        .then(response => {
            if (response.ok) {
                loggedIn = true;
                router.reload();
            }
        })
        .catch(error => {
            console.log(error);
        }); */
    }
</script>

<Layout>
    <CenterDiv>
        <div class="tw-text-center">
            {#if $page.props.auth.user}
                <div class="tw-text-center">
                    {#if loggedIn == true}
                        <h1 class="tw-mb-6">Sie wurden angemeldet.</h1>
                    {:else}
                        <h1 class="tw-mb-6">Sie sind bereits angemeldet.</h1>
                    {/if}
                    <Button link="/events">Events</Button>
                </div>
            {:else}
                <div class=" tw-bg-gray-50 tw-border tw-p-5 tw-rounded-xl">
                    <h1 class="tw-mb-5">Anmelden</h1>
                    <form on:submit|preventDefault={submit}>
                        <div class="tw-mb-3">
                            <label for="email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">E-Mail</label>
                            <input type="email" name="email" id="email" class="tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm" placeholder="E-Mail" bind:value={credentials.email}>
                            <span class="tw-text-red-500 tw-text-sm">{errors.email}</span>
                        </div>
                        <div class="tw-mb-3">
                            <label for="password" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Passwort</label>
                            <input type="password" name="password" id="password" class="tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm" placeholder="Passwort" bind:value={credentials.password}>
                            <span class="tw-text-red-500 tw-text-sm">{errors.password}</span>
                        </div>
                        <div class="tw-mb-3">
                            <label for="remember" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Sitzung speichern</label>
                            <input type="checkbox" name="remember" id="remember" class="tw-shadow-none tw-mt-1 tw-p-2 tw-block tw-w-full tw-border tw-border-gray-300 tw-rounded-md focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm" bind:checked={credentials.remember}>
                        </div>
                        <div class="tw-mb-3">
                            <SubmitButton>Login</SubmitButton>
                        </div>
                    </form>
                </div>
                <div class="tw-text-center tw-mt-2">
                    <Link class="tw-text-sm tw-text-gray-700 hover:tw-text-black" href="/resetpassword">Passwort vergessen?</Link><br>
                    <Link class="tw-text-sm tw-text-gray-700 hover:tw-text-black" href="/register">Registrieren</Link>
                </div>
            {/if}
        </div>
    </CenterDiv>
</Layout>