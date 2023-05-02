<template>
  <div class="mx-auto" style="width: 500px">
    <div class="mb-3">
      <label class="col-sm-2 col-form-label">Email</label>
      <input
        v-model="email"
        class="form-control"
        type="email"
        placeholder="Email"
        aria-label="default input example"
      />
    </div>
    <div class="mb-3">
      <label class="col-sm-2 col-form-label">Password</label>
      <input
        v-model="password"
        class="form-control"
        type="password"
        placeholder="Password"
        aria-label="default input example"
      />
    </div>
    <div class="mb-3">
      <label class="col-sm-2 col-form-label">Name</label>
      <input
        v-model="name"
        class="form-control"
        type="text"
        placeholder="Name"
        aria-label="default input example"
      />
    </div>
    <div class="d-flex justify-content-between align-items-center">
      <div>
        Already a member?
        <NuxtLink to="/" class="text-primary"> Login here! </NuxtLink>
      </div>
      <button class="btn btn-primary px-5" @click="register">Register</button>
    </div>
  </div>
</template>

<script setup>
const email = ref("");
const name = ref("");
const password = ref("");
const router = useRouter();

const register = async () => {
  const data = {
    email: email.value,
    name: name.value,
    password: password.value,
    password_confirmation: password.value,
  };

  return await $fetch("http://127.0.0.1:8000/api/register", {
    method: "POST",
    body: data,
  })
    .then((res) => {
      localStorage.setItem("token", res.data.token);
      router.push("/dashboard");
    })
    .catch((err) => {
      console.log("register failed", err);
    });
};
</script>
