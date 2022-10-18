<script>
    import axios from "axios";
    import Layout from "../Shared/Layout.svelte";
    import Form from "../Shared/Form.svelte";
    import H1 from "../Shared/H1.svelte";
    import { router } from "@inertiajs/svelte";
    import Subtitle from "../Shared/Subtitle.svelte";

    let data = [{
        name: 'E-Mail',
        value: '',
        bind: 'email',
        type: 'email',
        errorname: 'email',
        error: '',
    }]

    let sent = false;
    let submit = () => {
        let submitData = {
            email: data[0].value,
        };
        axios.post('/password/forgot', submitData)
            .then(response => {
                sent = true;
            })
            .catch(error => {
                console.log(error);
                if (error.response.status === 422) {
                    data[0]["error"] = error.response.data.errors[["email"]];
                }
            });
    };
    let cancel = () => {
        router.get('/login');
    };

</script>

<Layout>
    <H1 mb={false}>Passwort zurücksetzen</H1>
    <Subtitle>Setze dein Passwort zurück.</Subtitle>
    {#if sent}
        <span class="tw-text-green-700 tw-mb-4">Wir haben dir einen Link zum Zurücksetzen deines Passworts gesendet.</span>
    {:else}
        <Form onSubmit={submit} onCancel={cancel} newInstance={true} {data}></Form>
    {/if}
</Layout>