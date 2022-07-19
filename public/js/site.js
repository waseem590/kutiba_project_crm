// preparing delete method
const deleteRecord = (id, uri) => {

    document.getElementById('identity').value;
    let route = window.location.origin + uri + id;
    document.getElementById('deleteForm').setAttribute('action', route)
    $('#deleteModal').modal('show')
}
