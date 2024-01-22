const autoDispenseCheckbox = document.querySelector('#autoDispense');
const alarmsElement = document.querySelector('.alarms');

autoDispenseCheckbox.addEventListener('change', function() {
    if (autoDispenseCheckbox.checked) {
        alarmsElement.style.display = 'block';
    } else {
        alarmsElement.style.display = 'none';
    }
});
