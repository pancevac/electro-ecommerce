import Toasted from 'vue-toasted';

export default function (Vue) {

  Vue.use(Toasted, {
    iconPack : 'fontawesome'
  });

  // Options to the toast notification
  let optionsDefault = {
    //icon: 'check_circle',
    action: [
      {
        text: 'X',
        onClick: (e, toastObject) => {
          toastObject.goAway(0);
        }
      }
    ],
    duration: 5000
  };

  // Options to the toast notification
  let optionsSuccess = {
    icon: 'check_circle',
    theme: 'toasted-primary',
    action: [
      {
        text: 'X',
        onClick: (e, toastObject) => {
          toastObject.goAway(0);
        }
      }
    ],
    duration: 5000
  };

  // Options to the toast notification
  let optionsError = {
    type: 'error',
    icon: 'error_outline',
    action: [
      {
        text: 'X',
        onClick: (e, toastObject) => {
          toastObject.goAway(0);
        }
      }
    ],
    duration: 5000
  };

  // Register the toast with the custom message
  Vue.toasted.register('toastDefault', (payload) => {

      // if there is no message passed show default message
      if (!payload.message) {
        return 'Successful action!'
      }

      // if there is a message show it with the message
      return payload.message
    },
    optionsDefault
  );

  // Register the toast with the custom message
  Vue.toasted.register('toastSuccess', (payload) => {

      // if there is no message passed show default message
      if (!payload.message) {
        return 'Successful action!'
      }

      // if there is a message show it with the message
      return payload.message
    },
    optionsSuccess
  );

  // Register the toast with the custom message
  Vue.toasted.register('toastError', (payload) => {

      // if there is no message passed show default message
      if (! payload.message) {
        return 'Error!'
      }

      // if there is a message show it with the message
      return payload.message
    },
    optionsError
  );
}