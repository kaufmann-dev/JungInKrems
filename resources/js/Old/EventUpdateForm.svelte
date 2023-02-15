<script>
    export let event;
    import SubmitButton from "../Shared/SubmitButton.svelte";
    import { router, inertia } from "@inertiajs/svelte";
    import Button from "../Shared/Button.svelte";
    import DeleteButton from "../Shared/DeleteButton.svelte";
    export let onSubmit;

    function updateVariable() {
        onSubmit();
    }

    let data = {
        TITLE: event.TITLE,
        DESCRIPTION: event.DESCRIPTION,
        EVENT_TYPE: event.EVENT_TYPE,
        STARTING_TIME: event.STARTING_TIME,
        ENDING_TIME: event.ENDING_TIME,
        CITY: event.CITY,
        POSTAL_CODE: event.POSTAL_CODE,
        ADDRESS: event.ADDRESS,
        PHONE_NR: event.PHONE_NR,
        WEBSITE_URL: event.WEBSITE_URL,
        EMAIL: event.EMAIL,
        IMAGE_PATH: event.IMAGE_PATH,
    };

    let errors = {
        TITLE: '',
        DESCRIPTION: '',
        EVENT_TYPE: '',
        STARTING_TIME: '',
        ENDING_TIME: '',
        CITY: '',
        POSTAL_CODE: '',
        ADDRESS: '',
        PHONE_NR: '',
        WEBSITE_URL: '',
        EMAIL: '',
        IMAGE_PATH: '',
    };

    let deleteEvent = () => {
        if(window.confirm('Möchten Sie das Event wirklich löschen?')) {
            
            router.delete('/events/' + event.EVENT_ID).get('/events');
        }
    }

    let submit = () => {
      axios.put('/events/' + event.EVENT_ID, data)
      .then(response => {
          if (response.status === 200) {
            updateVariable();
          }
      })
      .catch(error => {
          if (error?.response?.status === 422) {
            for (const [key, value] of Object.entries(errors)) {
              if(error.response.data.errors[key]) {
                errors[key] = error.response.data.errors[key][0];
              } else {
                errors[key] = '';
              }
            }
          }
      });
    }
</script>

<form on:submit|preventDefault={submit} class="tw-w-full tw-bg-white tw-p-6">
    <h2 class="tw-text-lg tw-font-bold tw-mb-4">Update Event Information</h2>
    <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-700 tw-font-bold tw-mb-2" for="title">
            Title
        </label>
        <input
            class="tw-shadow tw-appearance-none tw-border tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
            id="title"
            type="text"
            value="{event.TITLE}"
            on:input={(evt)=>data.TITLE = evt.target.value}
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
            value="{event.DESCRIPTION}"
            on:input={(evt)=>data.DESCRIPTION = evt.target.value}
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
            on:input={(evt)=>data.PHONE_NR = evt.target.value}
            value="{event.PHONE_NR}"
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
            on:input={(evt)=>data.STARTING_TIME = evt.target.value}
            value="{event.STARTING_TIME}"
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
            on:input={(evt)=>data.ENDING_TIME = evt.target.value}
            value="{event.ENDING_TIME}"
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
            on:input={(evt)=>data.WEBSITE_URL = evt.target.value}
            value="{event.WEBSITE_URL}"
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
            on:input={(evt)=>data.EMAIL = evt.target.value}
            value="{event.EMAIL}"
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
            on:input={(evt)=>data.POSTAL_CODE = evt.target.value}
            value="{event.POSTAL_CODE}"
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
            on:input={(evt)=>data.CITY = evt.target.value}
            value="{event.CITY}"
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
            on:intput={(evt)=>data.ADDRESS = evt.target.value}
            value="{event.ADDRESS}"
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
            on:input={(evt)=>data.IMAGE_PATH = evt.target.value}
            value="{event.IMAGE_PATH}"
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
            on:input={(evt)=>data.EVENT_TYPE = evt.target.value}
            value="{event.EVENT_TYPE}"
        >
            <option value="Freizeit">Freizeit</option>
            <option value="Bildung">Bildung</option>
        </select>
        <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.EVENT_TYPE}</span>
    </div>
    <SubmitButton>Update Event</SubmitButton>
    <div on:click={deleteEvent} class="tw-inline-block tw-ms-2">
        <DeleteButton>Delete</DeleteButton>
    </div>
</form>