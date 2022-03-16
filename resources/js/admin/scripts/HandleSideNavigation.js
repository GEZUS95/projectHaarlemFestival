export default function initAddEventBtn() {
    const addEventBtn = document.querySelector('.partials-admin-layout-sidenav-btn-add-events');

    if(addEventBtn === null)
        return;

    addEventBtn.addEventListener('click', () => {
        window.dispatchEvent(new CustomEvent("modal-create-event", {detail: true}))
    })
}