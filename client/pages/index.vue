<template>
  <div class="mx-auto" style="width: 500px">
    <div class="mb-3">
      <label class="col-sm-2 col-form-label">Email</label>
      <input
        v-model="loginEmail"
        class="form-control"
        type="text"
        placeholder="Email"
        aria-label="default input example"
      />
    </div>
    <div class="mb-3">
      <label class="col-sm-2 col-form-label">Password</label>
      <input
        v-model="loginPassword"
        class="form-control"
        type="password"
        placeholder="Password"
        aria-label="default input example"
      />
      <br />
      <button class="btn btn-primary px-5" @click="loginWithGoogle">
        Login with Google
      </button>
    </div>
    <div class="d-flex justify-content-between align-items-center">
      <div>
        Not a member?
        <NuxtLink to="/register" class="text-primary">
          Register here!
        </NuxtLink>
      </div>
      <button class="btn btn-primary px-5" @click="login">Login</button>
    </div>
  </div>
</template>

<script setup>
const loginEmail = ref("");
const loginPassword = ref("");
const router = useRouter();

const loginWithGoogle = async () => {
  return await $fetch("http://127.0.0.1:8000/api/auth/google/redirect", {
    method: "GET",
  })
    .then((res) => {
      window.location.href = res.data.redirect;
    })
    .catch((err) => {
      console.log("login failed", err);
    });
};

const login = async () => {
  const data = {
    email: loginEmail.value,
    password: loginPassword.value,
  };
  return await $fetch("http://127.0.0.1:8000/api/login", {
    method: "POST",
    body: data,
  })
    .then((res) => {
      localStorage.setItem("token", res.data.token);
      router.push("/dashboard");
    })
    .catch((err) => {
      console.log("login failed", err);
    });
};
</script>
