<script>
    export let facility;
    import { inertia } from '@inertiajs/svelte';
    import InfoText from './InfoText.svelte';
    import BookmarkButton from './BookmarkButton.svelte';
</script>

<div class="tw-border tw-rounded-md tw-bg-slate-50 tw-p-4 tw-mt-4 tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-4 tw-gap-4">
    <div class="tw-rounded-md tw-overflow-hidden tw-h-40">
        <img class="tw-object-cover tw-h-full tw-w-full" src="{facility.IMAGE_PATH}" alt="{facility.TITLE}">
    </div>
    <div>
        <h3 use:inertia="{{ href: "/facilities/"+facility.FACILITY_ID, method: 'get' }}" class="tw-cursor-pointer tw-underline tw-mb-3">{facility.NAME}</h3>
        <InfoText color="blue">{facility.FACILITY_TYPE}</InfoText>
        <BookmarkButton checkId={facility.FACILITY_ID} />
    </div>
    <div>
        <h4 class="tw-mb-3">Webseite</h4>
        <a href="{facility.WEBSITE_URL}" class="tw-underline">{facility.WEBSITE_URL}</a>
    </div>
    <div>
        <h4 class="tw-mb-3">Kontakt</h4>
        <InfoText mb="false" color="light">Addresse</InfoText>
        {facility.ADDRESS}, {facility.POSTAL_CODE} {facility.CITY}<br>
        <InfoText mt="true" mb="false" color="light">E-Mail</InfoText>
        {facility.EMAIL}
    </div>
</div>