<script>
    export let request;
    import { router } from "@inertiajs/svelte";
    import InfoText from "../Shared/InfoText.svelte";
    import Button from "./Button.svelte";
    import H3 from "./H3.svelte";

    function formatDate(dateString) {
        let date = new Date(dateString);

        let day = date.getDate().toString().padStart(2, '0');
        let month = (date.getMonth() + 1).toString().padStart(2, '0');
        let year = date.getFullYear();
        let hours = date.getHours().toString().padStart(2, '0');
        let minutes = date.getMinutes().toString().padStart(2, '0');
        
        return day + "." + month + "." + year + " - " + hours + ":" + minutes + " Uhr";
    }

    let deltrose = () => {
        if(window.confirm('Möchten Sie die Anfrage wirklich löschen?')) {
            
            router.visit(`/requests/delete/${request.REQUEST_ID}`, {
                preserveScroll: true,
                preserveState: true,
                method: 'post'
            });
        }
    }
</script>

<div class="tw-grid tw-gap-2 tw-border tw-rounded-md tw-bg-slate-50 tw-p-4 tw-mb-4">
    <div>
        <H3>Antrag Nr. {request.REQUEST_ID}</H3>
        
    </div>
    <div></div>
    <span><InfoText color="light">Typ</InfoText> {request.REQUEST_TYPE}</span>
    <span><InfoText color="light">Nachricht</InfoText> {request.MESSAGE}</span>
    <span><InfoText color="light">Status</InfoText>
    {#if request.STATUS == "Offen"}
        <InfoText color="gray">Offen</InfoText>
    {:else if request.STATUS == "Angenommen"}
        <InfoText color="green">Angenommen</InfoText>
    {:else if request.STATUS == "Abgelehnt"}
        <InfoText color="red">Abgelehnt</InfoText>
    {/if}</span>
    <span><InfoText color="light">Erstellt</InfoText> {formatDate(request.created_at)}</span>
    <span><InfoText color="light">Letzte Änderung</InfoText> {formatDate(request.updated_at)}</span>
    <div></div>
    <div on:click={deltrose}>
        <Button type="danger">Antrag löschen</Button>
    </div>
</div>