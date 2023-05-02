<template>
  <div class="mx-auto" style="width: 500px">
    <div class="mb-3">
      <label class="col-sm-2 col-form-label">User ID:</label>
      {{ userId }}
    </div>
    <div class="mb-3">
      <label class="col-sm-2 col-form-label">Email:</label>
      {{ email }}
    </div>
    <div class="mb-3">
      <label class="col-sm-2 col-form-label">Name:</label>
      {{ name }}
    </div>
    <div class="d-flex justify-content-end">
      <button class="btn btn-secondary px-5" @click="logout">Logout</button>
    </div>
  </div>
</template>

<script setup>
const email = ref("");
const name = ref("");
const userId = ref("");
const token = ref("");
const router = useRouter();

onMounted(async () => {
  token.value = localStorage.getItem("token");

  console.log(token.value);
  if (!token.value) {
    router.push("/");
  }

  await $fetch("http://127.0.0.1:8000/api/profile", {
    method: "GET",
    headers: { Authorization: `Bearer ${token.value}` },
  })
    .then((res) => {
      email.value = res.data.email;
      name.value = res.data.name;
      userId.value = res.data.id;
    })
    .catch((err) => {
      console.log("login failed", err);
    });
});

const logout = async () => {
  return await $fetch("http://127.0.0.1:8000/api/logout", {
    method: "POST",
    headers: { Authorization: `Bearer ${token.value}` },
  })
    .then((res) => {
      localStorage.setItem("token", "");
      router.push("/");
    })
    .catch((err) => {
      console.log(err);
    });
};
</script>
