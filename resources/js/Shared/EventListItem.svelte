<script>
    export let event;
    //export let listUpdated = () => {};
    import { inertia, router } from "@inertiajs/svelte";
    import InfoText from "../Shared/InfoText.svelte";
    import BookmarkButton from "./BookmarkButton.svelte";
    import H4 from "../Shared/H4.svelte";

    function formatDate(dateString) {
        let date = new Date(dateString);

        let day = date.getDate().toString().padStart(2, '0');
        let month = (date.getMonth() + 1).toString().padStart(2, '0');
        let year = date.getFullYear();
        let hours = date.getHours().toString().padStart(2, '0');
        let minutes = date.getMinutes().toString().padStart(2, '0');
        
        return day + "." + month + "." + year + " - " + hours + ":" + minutes + " Uhr";
    }
</script>

<div class="tw-border tw-rounded-md tw-bg-slate-50 tw-p-4 tw-mt-4 tw-grid tw-gap-4 tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-4">
    <img class="tw-shadow tw-rounded-md tw-overflow-hidden tw-h-40 tw-object-cover tw-w-full" src="/images/uploads/{event.IMAGE_PATH}" alt="{event.TITLE}">
    <div>
        <span on:click={router.get('/events/' + event.EVENT_ID)} class="tw-block tw-text-2xl tw-font-medium tw-underline-offset-4 tw-decoration-1 tw-cursor-pointer tw-underline tw-mb-3 hover:tw-no-underline">{event.TITLE}</span>
        <!-- use:inertia="{{ href: "events/"+event.EVENT_ID, method: 'get' }}"-->
        {#if event.facility?.FACILITY_ID}
            <InfoText mb="true" color="gray">{event.facility?.NAME}</InfoText>
        {:else}
            <InfoText mb="true" color="gray">{event.account?.NAME}</InfoText>
        {/if}
        {#if event.EVENT_TYPE == "Bildung"}
            <br>
            <InfoText color="blue">Bildung</InfoText>
        {:else}
            <br>
            <InfoText color="green">Freizeit</InfoText>
        {/if}
        <!--<BookmarkButton bookmarkUpdated={listUpdated} checkId={event.EVENT_ID} />-->
        <BookmarkButton checkId={event.EVENT_ID} />
    </div>
    <div>
        <H4>Zeit</H4>
        <InfoText mb="false" color="light">Beginn</InfoText>
        {formatDate(event.STARTING_TIME)}
        {#if event.ENDING_TIME}
            <InfoText mb="false" color="light">Ende</InfoText>
            {formatDate(event.ENDING_TIME)}
        {/if}
    </div>
    <div>
        <H4 class="tw-mb-3">Standort</H4>
        <span>{event.ADDRESS},<br>{event.POSTAL_CODE} {event.CITY}</span>
    </div>
</div>