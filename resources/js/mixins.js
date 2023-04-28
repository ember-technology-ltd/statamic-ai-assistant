export const GeneratorMixin = {
	data() {
		return {
			processing: false,
			result: null,
			errors: {},
		}
	},
	methods: {
		async request(name, postData) {
			// if (!confirm('This will overwrite the current description. Are you sure?')) {
			//     return;
			// }
			this.errors = {};
			this.processing = true;

			try {
				const response = await Statamic.$request.post(
					`/cp/addons/jezzdk/statamic-ai-assistant/${name}`,
					postData,
				);

				this.result = response.data;
			} catch (error) {
				if (error.response.data.errors) {
					this.errors = error.response.data.errors;
				} else {
					alert(
						error.response.data.message ||
							"An error occurred. Please try again.",
					);
				}
			}

			this.processing = false;
		},
	},
};
