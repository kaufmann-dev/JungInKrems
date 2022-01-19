<script>
    import SubmitButton from "../Shared/SubmitButton.svelte";
    import DeleteButton from "../Shared/DeleteButton.svelte";

    export let onSubmit;
    export let onDelete;
    export let newEvent;
    export let data;
    export let errors;

    let deleteEvent = () => {
        onDelete();
    }

    let submit = () => {
        onSubmit();
    }
</script>

<form on:submit|preventDefault={submit} class="tw-w-full tw-bg-white tw-p-6">
    <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="title">
            Title
        </label>
        <input
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="title"
            type="text"
            bind:value={data.TITLE}
        />
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.TITLE}</span>
    </div>
    <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="description">
            Description
        </label>
        <textarea
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="description"
            bind:value={data.DESCRIPTION}
        ></textarea>
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.DESCRIPTION}</span>
    </div>
    <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="phone_nr">
            Phone Number
        </label>
        <input
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="phone_nr"
            type="text"
            bind:value={data.PHONE_NR}
        />
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.PHONE_NR}</span>
    </div>
    <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="starting_time">
            Starting Time
        </label>
        <input
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="starting_time"
            type="datetime-local"
            bind:value={data.STARTING_TIME}
        />
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.STARTING_TIME}</span>
    </div>
    <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="ending_time">
            Ending Time
        </label>
        <input
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="ending_time"
            type="datetime-local"
            bind:value={data.ENDING_TIME}
        />
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.ENDING_TIME}</span>
    
    </div>
    <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="website_url">
            Website URL
        </label>
        <input
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="website_url"
            type="text"
            bind:value={data.WEBSITE_URL}
        />
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.WEBSITE_URL}</span>
    </div>
    <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="email">
            Email
        </label>
        <input
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="email"
            type="email"
            bind:value={data.EMAIL}
        />
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.EMAIL}</span>
    </div>
    <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="postal_code">
            Postal Code
        </label>
        <input
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="postal_code"
            type="text"
            bind:value={data.POSTAL_CODE}
        />
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.POSTAL_CODE}</span>
    </div>
    <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="city">
            City
        </label>
        <input
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="city"
            type="text"
            bind:value={data.CITY}
        />
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.CITY}</span>
    </div>
    <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="address">
            Address
        </label>
        <input
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="address"
            type="text"
            bind:value={data.ADDRESS}
        />
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.ADDRESS}</span>
    </div>
    <div class="tw-mb-4">
    <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="image_path">
        Image Path
    </label>
        <input
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="image_path"
            type="text"
            bind:value={data.IMAGE_PATH}
        />
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.IMAGE_PATH}</span>
    </div>
    <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="event_type">
            Event Type
        </label>
        <select
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="event_type"
            type="text"
            bind:value={data.EVENT_TYPE}
        >
            <option value="Freizeit">Freizeit</option>
            <option value="Bildung">Bildung</option>
        </select>
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.EVENT_TYPE}</span>
    </div>
    <SubmitButton>Submit</SubmitButton>
    {#if newEvent === false}
        <div on:click={deleteEvent} class="tw-inline-block tw-ms-2">
            <DeleteButton>Delete</DeleteButton>
        </div>
    {/if}
</form>