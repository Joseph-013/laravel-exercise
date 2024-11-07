import Authad

export default function Dashboard() {
    return (
        <AuthenticatedAdminLayout
            header={
                <h2 className="flex items-center justify-between text-xl font-semibold leading-tight text-gray-800">
                    <div>Dashboard</div>
                    <NewCardDialog />
                </h2>
            }
        >
            <Head title="Dashboard" />
        </AuthenticatedAdminLayout>
    );
}
