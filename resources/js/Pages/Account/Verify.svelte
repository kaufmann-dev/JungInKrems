<script>
    import AccLayout from "../../Shared/AccLayout.svelte";
    import Button from "../../Shared/Button.svelte";
    import { page } from '@inertiajs/svelte';
    import H1 from "../../Shared/H1.svelte";
    import Subtitle from "../../Shared/Subtitle.svelte";

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
    <Subtitle>Bestätige deine E-Mail Adresse.</Subtitle>
    {#if error500}
        <span class="tw-text-red-500 tw-mb-4">{error500}</span>
    {:else if isVerified}
        <span class="tw-text-green-700 tw-mb-4">Ihre E-Mail Adresse ist bestätigt.</span>
    {:else if sent}
        <span class="tw-text-green-700 tw-mb-4">Wir haben dir eine E-Mail Adresse geschickt. Überprüfe dein Postfach und deinen Spam Ordner.</span>
    {:else}
        <span class="tw-text-red-500 tw-mb-4 tw-block">Ihre E-Mail Adresse wurde noch nicht bestätigt.</span>
        <Button onClick={sendEmail}>Link schicken</Button>
    {/if}
</AccLayout>