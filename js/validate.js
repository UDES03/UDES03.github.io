function validateForm(formData) {
  const name = formData.name.trim();
  const address = formData.address.trim();
  const email = formData.email.trim();

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  return {
    valid: name.length > 0 && address.length > 0 && emailRegex.test(email),
    nameValid: name.length > 0,
    addressValid: address.length > 0,
    emailValid: emailRegex.test(email),
  };
}
