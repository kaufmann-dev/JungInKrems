<script>
    import SubmitButton from "../Shared/SubmitButton.svelte";
    import DeleteButton from "../Shared/DeleteButton.svelte";

    export let onSubmit;
    export let onDelete;
    export let newInstance;
    export let data;
    export let errors;

    let handleDelete = () => {
        onDelete();
    }

    let submit = () => {
        onSubmit();
    }
</script>

<form on:submit|preventDefault={submit} class="tw-w-full tw-bg-white tw-p-6">
    <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="name">
            Name
        </label>
        <input
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="name"
            type="text"
            bind:value={data.NAME}
        />
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.NAME}</span>
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
        <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="password">
            Password
        </label>
        <input
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="password"
            type="password"
            bind:value={data.PASSWORD}
        />
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.PASSWORD}</span>
    </div>
    <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="is_email_verified">
            Email Verified
        </label>
        <input
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="is_email_verified"
            type="checkbox"
            bind:checked={data.IS_EMAIL_VERIFIED}
        />
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.IS_EMAIL_VERIFIED}</span>
    </div>
    <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="account_type">
            Account Type
        </label>
        <select
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="account_type"
            bind:value={data.account_type}
        >
            <option value="personal">Personal</option>
            <option value="business">Business</option>
        </select>
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.account_type}</span>
    </div>
    <div class="tw-flex tw-justify-center">
        <button
            class="tw-bg-blue-500 tw-text-white tw-font-bold tw-py-2 tw-px-4 tw-rounded tw-hover:tw-bg-blue-400"
        >
            Submit
        </button>
    </div>
</form>