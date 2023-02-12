<script>
    import { page, router } from '@inertiajs/svelte';
    import Layout from '../Shared/Layout.svelte';
    import SubmitButton from '../Shared/SubmitButton.svelte';
    import CenterDiv from '../Shared/CenterDiv.svelte';

    let registered = false;

    let data = {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      terms: false
    };

    let errors = {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      terms: ''
    };

    let submit = () => {
      axios.post('register', {
          name: data.name,
          email: data.email,
          password: data.password,
          password_confirmation: data.password_confirmation,
          terms: data.terms
      })
      .then(response => {
          if (response.status === 200) {
            registered = true;
          }
      })
      .catch(error => {
          
          console.log(error);
          if (error?.response?.status === 422) {
            for (const [key, value] of Object.entries(errors)) {
              if(error.response.data.errors[key]) {
                errors[key] = error.response.data.errors[key][0];
              } else {
                errors[key] = '';
              }
            }
          }
          for (const [key, value] of Object.entries(errors)) {
            console.log(`${key}: ${value}`);
          }
      });
    }
</script>

<Layout>
    <CenterDiv>
      {#if registered == true}
        <div class="tw-text-center">
          <h1 class="tw-mb-6">Sie wurden registriert.</h1>
          <SubmitButton link="/login" text="Anmelden"/>
        </div>
      {:else}
        <form on:submit|preventDefault={submit} class="tw-text-center tw-bg-slate-100 tw-p-8 tw-rounded-md">
            <div class="tw-flex tw-flex-col tw-w-full tw-mb-6">
              <label class="tw-text-lg tw-mb-2" for="username">Username</label>
              <input on:input={(evt)=>data.name = evt.target.value} class="tw-border tw-border-gray-400 tw-rounded tw-w-full tw-py-2 tw-px-3" type="text" id="username" />
              <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.name}</span>
            </div>
          
            <div class="tw-flex tw-flex-col tw-w-full tw-mb-6">
              <label class="tw-text-lg tw-mb-2" for="email">Email</label>
              <input on:input={(evt)=>data.email = evt.target.value} class="tw-border tw-border-gray-400 tw-rounded tw-w-full tw-py-2 tw-px-3" type="email" id="email" />
              <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.email}</span>
            </div>
          
            <div class="tw-flex tw-flex-col tw-w-full tw-mb-6">
              <label class="tw-text-lg tw-mb-2" for="password">Password</label>
              <input on:input={(evt)=>data.password = evt.target.value} class="tw-border tw-border-gray-400 tw-rounded tw-w-full tw-py-2 tw-px-3" type="password" id="password" />
              <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.password}</span>
            </div>
          
            <div class="tw-flex tw-flex-col tw-w-full tw-mb-6">
              <label class="tw-text-lg tw-mb-2" for="password-confirm">Confirm Password</label>
              <input on:input={(evt)=>data.password_confirmation = evt.target.value} class="tw-border tw-border-gray-400 tw-rounded tw-w-full tw-py-2 tw-px-3" type="password" id="password-confirm" />
              <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.password_confirmation}</span>
            </div>

            <div class="tw-mb-4">
              <label for="acceptDataAgreements" class="tw-block tw-text-gray-700 tw-font-bold tw-mb-1">Accept <a class="tw-text-gray-700 hover:tw-text-black" href="https://www.krems.at/datenschutzerklaerung">Data Agreements</a></label>
              <input on:input={(evt)=>data.terms = evt.target.checked} type="checkbox" class="tw-mt-1" id="acceptDataAgreements" />
              <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.terms}</span>
            </div>

            <SubmitButton>Create Account</SubmitButton>
          </form>

            <div class="tw-text-center tw-mt-4">
                <a href="/login">Ich habe bereits einen Account</a>
            </div>
      {/if}
    </CenterDiv>
</Layout>