<script>
    import AccLayout from "../../Shared/AccLayout.svelte";
    import Button from "../../Shared/Button.svelte";
    import { page, router } from '@inertiajs/svelte';
    import H1 from "../../Shared/H1.svelte";

    let error500 = "";
    let isVerified = false;
    if($page.props.auth.user.IS_EMAIL_VERIFIED == 1) {
        isVerified = true;
    }
    let sent = false;

    let sendEmail = () => {
        axios.post('/email/send-verification')
            .then(response => {
                sent = true;
            })
            .catch(error => {
                error500 = "Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.";
            });
    };
</script>

<AccLayout>
    <H1 mb={false}>E-Mail bestätigen</H1>
    <p class="tw-text-gray-500 tw-border-b tw-pb-3">Bestätige deine E-Mail Adresse.</p>
    {#if error500}
        <p class="tw-text-red-500">{error500}</p>
    {:else if isVerified}
        <p class="tw-text-green-700">Ihre E-Mail Adresse ist bestätigt.</p>
    {:else if sent}
        <p class="tw-text-green-700">Wir haben dir eine E-Mail Adresse geschickt. Überprüfe dein Postfach und deinen Spam Ordner.</p>
    {:else}
        <p class="tw-text-red-500">Ihre E-Mail Adresse wurde noch nicht bestätigt.</p>
        <Button onClick={sendEmail}>Link schicken</Button>
    {/if}
</AccLayout>