<script>
    import Layout from "../Shared/Layout.svelte";
    import H1 from "../Shared/H1.svelte";
    import Form from "../Shared/Form.svelte";
    import { router } from "@inertiajs/svelte";
    import ErrorMessage from "../Shared/ErrorMessage.svelte";
    import Button from "../Shared/Button.svelte";
    import CenterDiv from "../Shared/CenterDiv.svelte";
    import HR from "../Shared/HR.svelte";

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
            if(element["value"] !== "" && element["value"] !== "NaN-NaN-NaNTNaN:NaN" && element["value"] !== null) {
            return {
                [element["bind"]]: element["value"]
            }
        }
        }).reduce((a, b) => Object.assign(a, b), {});

        submitdata["token"] = token;
        submitdata["email"] = email;

        axios.post('/password/reset', submitdata)
            .then(response => {
                reset = true;
            })
            .catch(error => {
                console.log(error);
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

<svelte:head>
    <title>Passwort zurücksetzen</title>
    <meta name="description" content="Passwort zurücksetzen">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
</svelte:head>

<CenterDiv>
    <div class="tw-p-3">
        <H1 mb={false}>Passwort zurücksetzen</H1>
        <HR/>
        {#if reset}
            <span class="tw-text-green-700 tw-mb-4 tw-block">Sie haben Ihr Passwort erfolgreich zurückgesetzt.</span>
            <Button link="/">Zurück zur Startseite</Button>
        {:else}
            <Form newInstance={true} onSubmit={submit} onCancel={cancel} {data}></Form>
            <ErrorMessage>{error500}</ErrorMessage>
        {/if}
    </div>
</CenterDiv>