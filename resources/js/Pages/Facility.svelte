<script>
    export let facility;
    import Layout from "../Shared/Layout.svelte";
    import InfoText from "../Shared/InfoText.svelte";
</script>

<Layout>
    <div class="tw-grid tw-gap-4 md:tw-grid-cols-2 tw-my-8">
        <div>
            <h1 class="tw-text-5xl tw-mb-6">{facility.NAME}</h1>
            <InfoText color="blue">{facility.FACILITY_TYPE}</InfoText>
            <div class="tw-text-xl tw-grid tw-gap-2 tw-mt-4">
                <div class="tw-flex">
                    <i class="tw-mx-3 tw-text-blue-500 bi bi-geo-alt-fill"></i> <span>{facility.ADDRESS}, {facility.POSTAL_CODE} {facility.CITY}</span>
                </div>
                <div>
                    <i class="tw-mx-3 tw-text-blue-500 bi bi-telephone-fill"></i> <span>{facility.PHONE_NR}</span>
                </div>
                <div>
                    <i class="tw-mx-3 tw-text-blue-500 bi bi-link-45deg"></i> <a href="{facility.WEBSITE_URL}">{facility.WEBSITE_URL}</a>
                </div>
                <div>
                    <i class="tw-mx-3 tw-text-blue-500 bi bi-envelope-fill"></i> <span>{facility.EMAIL}</span>
                </div>
            </div>
        </div>
        <div>
            <img class="tw-object-cover tw-h-full tw-w-full tw-rounded-xl" src="{facility.IMAGE_PATH}" alt="{facility.NAME}">
        </div>
    </div>
    <h3>Beschreibung</h3>
    <p>{facility.DESCRIPTION}</p>
</Layout>