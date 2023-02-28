<script>
    import { page, router } from '@inertiajs/svelte';
    import AccLayout from "../Shared/AccLayout.svelte";
    import InfoText from '../Shared/InfoText.svelte';
    import Button from '../Shared/Button.svelte';
    import Form from '../Shared/Form.svelte';
    import H1 from "../Shared/H1.svelte";
    
    $: user = $page.props.auth.user;
    let editing = false;
    let editingPassword = false;
    $: userArray = [
      {
        name: 'Name',
        value: user.NAME,
        bind: 'NAME',
        type: 'text',
        errorname: 'NAME',
        error: ''
      },
      {
        name: 'E-Mail-Adresse',
        value: user.EMAIL,
        bind: 'EMAIL',
        type: 'string',
        errorname: 'EMAIL',
        error: ''
      }
    ];
    $: passwordArray = [
      {
        name: 'Altes Passwort',
        value: '',
        bind: 'OLD_PASSWORD',
        type: 'password',
        errorname: 'OLD_PASSWORD',
        error: ''
      },
      {
        name: 'Neues Passwort',
        value: '',
        bind: 'PASSWORD',
        type: 'password',
        errorname: 'PASSWORD',
        error: ''
      },
      {
        name: 'Neues Passwort wiederholen',
        value: '',
        bind: 'PASSWORD_CONFIRMATION',
        type: 'password',
        errorname: 'PASSWORD_CONFIRMATION',
        error: ''
      }
    ];

    function deleteAccount()
    {
        if(confirm("Möchten Sie Ihren Account wirklich löschen?"))
        {
            axios.post('/account/delete', {})
            .then(response => {
                if (response.status === 200) {
                  router.reload();
                }
            });
        }
    }

    let cancel = () => {
        editing = false;
        editingPassword = false;
    }

    let resetPassword = () => {
      let submitdata = passwordArray.map(element => {
        if(element["value"] !== "" && element["value"] !== "NaN-NaN-NaNTNaN:NaN" && element["value"] !== null) {
          return {
              [element["bind"]]: element["value"]
          }
        }
      }).reduce((a, b) => Object.assign(a, b), {});

      axios.post('/reset-password', submitdata)
      .then(response => {
          if (response.status === 200) {
            cancel();
            passwordArray.forEach(element => {
              element["error"] = "";
              element["value"] = "";
            });
          }
      })
      .catch(error => {
        if (error?.response?.status === 422) {
          for (const [key, value] of Object.entries(passwordArray)) {
            if(error.response.data.errors[value["errorname"]]) {
              passwordArray[key]["error"] = error.response.data.errors[value["errorname"]][0];
            } else {
              passwordArray[key]["error"] = "";
            }
          }
        }
      });
    }

    let submit = () => {
      let submitdata = userArray.map(element => {
        if(element["value"] !== "" && element["value"] !== "NaN-NaN-NaNTNaN:NaN" && element["value"] !== null) {
            return {
                [element["bind"]]: element["value"]
            }
          }
        }).reduce((a, b) => Object.assign(a, b), {});

        axios.post('/account', submitdata)
        .then(response => {
            if (response.status === 200) {
              userArray.forEach(element => {
                element["error"] = "";
              });
              cancel();
              router.reload();
            }
        })
        .catch(error => {
          if (error?.response?.status === 422) {
            for (const [key, value] of Object.entries(userArray)) {
                if(error.response.data.errors[value["errorname"]]) {
                  userArray[key]["error"] = error.response.data.errors[value["errorname"]][0];
                } else {
                  userArray[key]["error"] = "";
                }
            }
          }
        });
    }
</script>

<AccLayout>
  {#if editing}

    <H1 class="tw-my-6">Benutzerdaten ändern</H1>
    <div class="tw-border-b tw-mb-3"></div>
    <Form newInstance={true} data={userArray} onCancel={cancel} onSubmit={submit}></Form>

  {:else if editingPassword}

    <H1 class="tw-my-6">Passwort ändern</H1>
    <div class="tw-border-b tw-mb-3"></div>
    <Form newInstance={true} data={passwordArray} onCancel={cancel} onSubmit={resetPassword}></Form>

    {:else}

    <H1 class="tw-my-6">Willkommen <span class="tw-text-yellow-400">{user.NAME}</span>!</H1>
        <span>E-Mail-Adresse: </span><InfoText>{user.EMAIL}</InfoText>
        {#if user.IS_EMAIL_VERIFIED}
            <span class="tw-text-green-700">Deine E-Mail-Adresse wurde bestätigt!</span>
        {:else}
            <Button size="small" link="/account/verify"><div class="tw-mx-2">Jetzt bestätigen</div></Button>
        {/if}
    <div class="tw-border-b tw-my-3"></div>
    <div class="tw-grid tw-gap-4 md:tw-grid-cols-3">
        <Button onClick={()=>editing = true}><i class="bi bi-pencil-fill"></i> Benutzerdaten ändern</Button>
        <Button onClick={()=>editingPassword = true}><i class="bi bi-key-fill"></i> Passwort ändern</Button>
        <Button type='danger' onClick={deleteAccount}><i class="bi bi-trash-fill"></i> Account löschen</Button>
    </div>
  {/if}
</AccLayout>

<!-- <div class="tw-bg-white tw-p-6 tw-shadow-md tw-rounded-lg">
    <h1 class="tw-text-lg tw-font-bold tw-mb-4">User Settings</h1>
    <form class="tw-flex tw-flex-col tw-w-full tw-mb-4">
      <label class="tw-mb-2 tw-text-gray-700">Name:</label>
      <input type="text" class="tw-border tw-border-gray-400 tw-py-2 tw-px-4 tw-rounded-lg tw-w-full">
    </form>
    <form class="tw-flex tw-flex-col tw-w-full tw-mb-4">
      <label class="tw-mb-2 tw-text-gray-700">Email:</label>
      <input type="email" class="tw-border tw-border-gray-400 tw-py-2 tw-px-4 tw-rounded-lg tw-w-full">
    </form>
    <form class="tw-flex tw-flex-col tw-w-full">
      <label class="tw-mb-2 tw-text-gray-700">Password:</label>
      <input type="password" class="tw-border tw-border-gray-400 tw-py-2 tw-px-4 tw-rounded-lg tw-w-full">
    </form>
    <button class="tw-bg-blue-500 tw-text-white tw-py-2 tw-px-4 tw-rounded-lg tw-mt-4 tw-w-full tw-text-center tw-text-sm tw-font-medium tw-hover:bg-blue-600">Save Changes</button>
  </div>
   -->