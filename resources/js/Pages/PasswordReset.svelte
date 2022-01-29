<script>
    import Layout from "../Shared/Layout.svelte";
    import H1 from "../Shared/H1.svelte";
    import Form from "../Shared/Form.svelte";
    import { router, Link } from "@inertiajs/svelte";
    import ErrorMessage from "../Shared/ErrorMessage.svelte";
    import Button from "../Shared/Button.svelte";

    let searcher = new URLSearchParams(window.location.search);
    let email = searcher.get('email');
    let token = searcher.get('token');
    let error500 = "";

    let reset = false;
    $: data = [{
        name: 'Neues Passwort',
        value: '',
        bind: 'PASSWORD',
        type: 'password',
        errorname: 'PASSWORD',
        error: '',
    }, {
        name: 'Passwort wiederholen',
        value: '',
        bind: 'PASSWORD_CONFIRMATION',
        type: 'password',
        errorname: 'PASSWORD_CONFIRMATION',
        error: '',
    }];

    let cancel = () => {
        router.get('/');
    };

    let submit = () => {
        let submitdata = data.map(element => {
            return {
                [element["bind"]]: element["value"]
            }
        }).reduce((a, b) => Object.assign(a, b), {});

        submitdata["token"] = token;
        submitdata["email"] = email;

        axios.post('/password/reset', submitdata)
            .then(response => {
                reset = true;
            })
            .catch(error => {
                if (error.response.status === 422) {
                    for (const [key, value] of Object.entries(data)) {
                        if(error.response.data.errors[value["errorname"]]) {
                            data[key]["error"] = error.response.data.errors[value["errorname"]][0];
                        } else {
                            data[key]["error"] = "";
                        }
                    }
                } else {
                    for (const [key, value] of Object.entries(data)) {
                        data[key]["error"] = "";
                    }
                    error500 = "Es ist ein Fehler aufgetreten. Bitte versuche es später erneut.";
                }
            });
    };
</script>

<Layout>
    <H1>Passwort zurücksetzen</H1>
    {#if reset}
        <p>Dein Passwort wurde erfolgreich zurückgesetzt.</p>
        <Button link="/login">Zum Login</Button>
    {:else}
        <Form newInstance={true} onSubmit={submit} onCancel={cancel} {data}></Form>
        <ErrorMessage>{error500}</ErrorMessage>
    {/if}
</Layout>