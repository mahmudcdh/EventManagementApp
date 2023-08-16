<x-app-layout>

    <div class="py-12">
        <div class="row">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white bg-400 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <h3 class="mb-4">Event List</h3>
                            <table id="eventTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="tbody"></tbody>
                            </table>



                        </section>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        eventList()
        async function eventList(){
            let res = await axios.get('/apiEventsList')
            let eventTable = $('#eventTable')
            let tbody = $('#tbody')
            //incomeTable.DataTable().destroy();
            tbody.empty()
            res.data.forEach((item, index)=>{
                let row = (`<tr>
            <td>${index +1}</td>
            <td>${item['title']}</td>
            <td>${item['location']}</td>
            <td>
                <a onclick="btnEdit(${item['id']})" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                <a id="btnDelete" class="btn btn-danger btn-sm" onclick="btnDelete(${item['id']})"><i class="fas fa-trash"></i></a>
            </td>
        </tr>`)
                tbody.append(row)
            })
            eventTable.DataTable({
                order: [[0, 'asc']],
                lengthMenu: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50],
                language: {
                    paginate: {
                        next: '&#8594;', // or '→'
                        previous: '&#8592;' // or '←'
                    }
                }
            })
        }
    </script>

</x-app-layout>
