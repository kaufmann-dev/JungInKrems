<script>
    export let facility;
    import { inertia } from '@inertiajs/svelte';
    import InfoText from './InfoText.svelte';
    import BookmarkButton from './BookmarkButton.svelte';
    import H4 from './H4.svelte';
</script>

<div class="tw-border tw-rounded-md tw-bg-slate-50 tw-p-4 tw-mt-4 tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-4 tw-gap-4">
    <img class="tw-shadow tw-rounded-md tw-overflow-hidden tw-h-40 tw-object-cover tw-w-full" src="/images/uploads/{facility.IMAGE_PATH}" alt="{facility.NAME}">
    <div>
        <span use:inertia="{{ href: "/facilities/"+facility.FACILITY_ID, method: 'get' }}" class="tw-block tw-text-2xl tw-font-medium tw-underline-offset-4 tw-decoration-1 tw-cursor-pointer tw-underline tw-mb-3 hover:tw-no-underline">{facility.NAME}</span>
        <InfoText color="blue">{facility.FACILITY_TYPE}</InfoText>
        <BookmarkButton checkId={facility.FACILITY_ID} />
    </div>
    <div>
        <H4>Webseite</H4>
        <a href="{facility.WEBSITE_URL}" class="tw-underline">{facility.WEBSITE_URL}</a>
    </div>
    <div>
        <H4>Kontakt</H4>
        <InfoText mb="false" color="light">Addresse</InfoText>
        {facility.ADDRESS}, {facility.POSTAL_CODE} {facility.CITY}<br>
        <InfoText mt="true" mb="false" color="light">E-Mail</InfoText>
        {facility.EMAIL}
    </div>
</div>