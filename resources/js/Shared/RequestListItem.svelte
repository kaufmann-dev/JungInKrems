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
            router.post('/requests/delete/' + request.REQUEST_ID);
        }
    }
</script>

<div class="tw-grid tw-gap-2 tw-border tw-rounded-md tw-bg-slate-50 tw-p-4 tw-mb-4">
    <div>
        <H3>Typ: {request.REQUEST_TYPE}</H3>
        <span class="tw-clock tw-mb-3">Nachricht: {request.MESSAGE}</span>
    </div>
    <div></div>
    <span>Status:
    {#if request.STATUS == "Offen"}
        <InfoText color="gray">Offen</InfoText>
    {:else if request.STATUS == "Angenommen"}
        <InfoText color="green">Angenommen</InfoText>
    {:else if request.STATUS == "Abgelehnt"}
        <InfoText color="red">Abgelehnt</InfoText>
    {/if}</span>
    <span>Erstellt: <InfoText color="light">{formatDate(request.created_at)}</InfoText></span>
    <span>Letzte Änderung: <InfoText color="light">{formatDate(request.updated_at)}</InfoText></span>
    <div></div>
    <div on:click={deltrose}>
        <Button type="danger">Antrag löschen</Button>
    </div>
</div>