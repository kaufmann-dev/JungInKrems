<script>
    import { page, router, Link } from '@inertiajs/svelte';
    import Layout from '../Shared/Layout.svelte';
    import Button from '../Shared/Button.svelte';
    import CenterDiv from '../Shared/CenterDiv.svelte';
    import H1 from '../Shared/H1.svelte';
    import FloatingForm from '../Shared/FloatingForm.svelte';

    let loggedIn = false;

    $: credentials = [{
        name: 'E-Mail',
        bind: 'email',
        type: 'email',
        value: '',
        errorname: 'email',
        error: '',
    }, {
        name: 'Passwort',
        bind: 'password',
        type: 'password',
        value: '',
        errorname: 'password',
        error: '',
    }, {
        name: 'Angemeldet bleiben',
        bind: 'remember',
        type: 'checkbox',
        value: false,
        errorname: 'remember',
        error: '',
    }]

    function submit() {
        let submitdata = credentials.map(element => {
            if(element["value"] !== "" && element["value"] !== "NaN-NaN-NaNTNaN:NaN" && element["value"] !== null) {
            return {
                [element["bind"]]: element["value"]
            }
        }
        }).reduce((a, b) => Object.assign(a, b), {});

        axios.post('/login', submitdata)
        .then(response => {
            if (response.status === 200) {
                loggedIn = true;
                router.reload();
            }
        })
        .catch(error => {
            console.log(error);
            if (error?.response?.status === 422) {
                for (const [key, value] of Object.entries(credentials)) {
                    if(error.response.data.errors[value["errorname"]]) {
                        credentials[key]["error"] = error.response.data.errors[value["errorname"]][0];
                    } else {
                        credentials[key]["error"] = "";
                    }
                }
            }
        });
    }
</script>

<Layout>
    <CenterDiv>
        <div class="tw-text-center">
            {#if $page.props.auth.user}
                <div class="tw-text-center">
                    {#if loggedIn == true}
                        <H1 mb={false}>Sie wurden angemeldet.</H1>
                    {:else}
                        <H1 mb={false}>Sie sind bereits angemeldet.</H1>
                    {/if}
                    <Button link="/events">Events entdecken</Button>
                </div>
            {:else}
                <FloatingForm name="Anmelden" data={credentials} onSubmit={submit}></FloatingForm>
                <div class="tw-text-center tw-mt-2">
                    <Link class="tw-text-sm tw-text-gray-700 hover:tw-text-black" href="/forgotpassword">Passwort vergessen?</Link><br>
                    <Link class="tw-text-sm tw-text-gray-700 hover:tw-text-black" href="/register">Registrieren</Link>
                </div>
            {/if}
        </div>
    </CenterDiv>
</Layout>