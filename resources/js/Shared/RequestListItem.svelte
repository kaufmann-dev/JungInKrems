<script>
    export let request;
    import { router } from "@inertiajs/svelte";
    import axios from "axios";
    import InfoText from "../Shared/InfoText.svelte";
    import DeleteButton from "./DeleteButton.svelte";

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

<div class="tw-border tw-rounded-md tw-bg-slate-50 tw-p-4 tw-mt-4">
    <h3>{request.REQUEST_TYPE}</h3>
    <p>{request.MESSAGE}</p>
    <p>Status:
    {#if request.STATUS == "Offen"}
        <InfoText color="gray">Offen</InfoText>
    {:else if request.STATUS == "Angenommen"}
        <InfoText color="green">Angenommen</InfoText>
    {:else if request.STATUS == "Abgelehnt"}
        <InfoText color="red">Abgelehnt</InfoText>
    {/if}</p>
    <p>Erstellt: <InfoText color="light">{formatDate(request.created_at)}</InfoText></p>
    <p>Letzte Änderung: <InfoText color="light">{formatDate(request.updated_at)}</InfoText></p>
    <div on:click={deltrose}>
        <DeleteButton>Antrag löschen</DeleteButton>
    </div>
</div>