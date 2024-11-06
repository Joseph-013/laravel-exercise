import InputLabelCombo from '@/Components/InputLabelCombo';
import { Button } from '@/Components/ui/button';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, router } from '@inertiajs/react';
import { useEffect, useState } from 'react';

type Card = {
    id: number;
    profile_picture: string;
    profile_picture_file?: File;
    first_name: string;
    last_name: string;
    title: string;
    id_code: string;
    contact: string;
    blood_type: string;
};

export default function Dashboard({ cards }: { cards: Card[] }) {
    const [previewPanel, setPreviewPanel] = useState<Card>(cards[0] || null);
    const [saveButtonDisabled, setSaveButtonDisabled] = useState<boolean>(true);

    useEffect(() => {
        setSaveButtonDisabled(
            JSON.stringify(previewPanel) ===
                JSON.stringify(cards.find((value) => value.id === previewPanel.id)),
        );
    }, [previewPanel, cards]);

    useEffect(() => {
        setPreviewPanel((prev) => cards.find((card) => card.id === prev.id) || cards[0]);
    }, [cards]);

    const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const file = e.target.files?.[0];
        const newCard: Card = { ...previewPanel };
        // checks if same filename then reject
        if (file && file.name !== previewPanel?.profile_picture) {
            newCard['profile_picture'] = URL.createObjectURL(file);
            newCard['profile_picture_file'] = file;
        }

        setPreviewPanel(newCard);
    };

    const handleEditSave = () => {
        // console.log(previewPanel);
        router.post(route('auth.card.update', { card: previewPanel.id }), previewPanel, {
            // forceFormData: true,
            preserveState: true,
            preserveScroll: true,
        });
    };

    const handleDelete = (e: React.MouseEvent<HTMLButtonElement>) => {
        if (e.shiftKey) {
            router.delete(route('auth.card.forget', previewPanel.id));
            return;
        }
        router.delete(route('auth.card.delete', previewPanel.id));
    };

    const omittedKeys = ['profile_picture', 'profile_picture_file'];

    return (
        <AuthenticatedLayout
            header={
                <h2 className="flex items-center justify-between text-xl font-semibold leading-tight text-gray-800">
                    <div>Dashboard</div>
                    {/* <Button>+ Add Card</Button> */}
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="h-full py-5">
                <div className="mx-auto h-full max-w-7xl sm:px-6 lg:px-8">
                    {/* primary container */}
                    <div className="container mx-auto h-full">
                        {/* division */}
                        <div className="flex h-full w-full gap-x-5">
                            {/* left panel */}
                            <div className="h-fit w-7/12 overflow-hidden bg-white p-3 shadow-sm sm:rounded-lg lg:w-1/2">
                                <div className="flex w-full gap-x-5">
                                    <div className="relative flex w-1/2 overflow-hidden">
                                        <img
                                            src={route('image', 'id_template_left.jpg')}
                                            className="aspect-auto w-full"
                                            alt="test"
                                        />
                                        {previewPanel && (
                                            <>
                                                <div className="absolute inset-x-0 bottom-0 h-[35%] bg-white" />
                                                <div className="absolute left-1/2 top-[19%] aspect-square h-[43%] -translate-x-1/2 transform rounded-full">
                                                    <img
                                                        src={
                                                            previewPanel.profile_picture.startsWith(
                                                                'blob:',
                                                            )
                                                                ? previewPanel.profile_picture
                                                                : route(
                                                                      'image',
                                                                      previewPanel?.profile_picture ||
                                                                          'default.jpeg',
                                                                  )
                                                        }
                                                        className="aspect-square h-full w-full rounded-full object-cover object-center"
                                                    />
                                                </div>
                                                <div className="absolute inset-x-0 top-[67.5%] w-full leading-3">
                                                    <div className="flex h-[1.2em] w-full items-center justify-center truncate bg-white text-lg font-extrabold">
                                                        {previewPanel.first_name}
                                                        &nbsp;
                                                        {previewPanel.last_name}
                                                    </div>
                                                    <div className="flex h-[1em] w-full items-center justify-center bg-white text-sm text-cyan-700">
                                                        {previewPanel.title}
                                                    </div>
                                                </div>
                                                <div className="absolute inset-x-0 top-[78.9%] mt-3 flex w-full flex-col gap-y-1 bg-white text-xs">
                                                    {Object.entries({
                                                        ID: previewPanel.id_code,
                                                        Contact: previewPanel.contact,
                                                        Blood: previewPanel.blood_type,
                                                    }).map(([key, value]) => (
                                                        <div
                                                            key={key}
                                                            className="flex h-[1em] w-full scale-90 items-center justify-center"
                                                        >
                                                            {key}:&nbsp;
                                                            <span className="font-bold">
                                                                {value}
                                                            </span>
                                                        </div>
                                                    ))}
                                                </div>
                                            </>
                                        )}
                                    </div>
                                    <div className="relative w-1/2 overflow-hidden">
                                        <img
                                            src={'storage/id_template_right.jpg'}
                                            className="aspect-auto w-full"
                                            alt=""
                                        />
                                        {/* future sign picture */}
                                        {/* <div className="absolute left-1/2 top-[19%] aspect-square h-[43%] -translate-x-1/2 transform rounded-full">
                                            <img
                                                src="https://picsum.photos/id/237/500/500"
                                                className="aspect-square h-full w-full rounded-full object-cover"
                                            />
                                        </div> */}
                                    </div>
                                </div>
                                <div className="mt-5">
                                    <div className="grid grid-cols-2 gap-2">
                                        <InputLabelCombo
                                            placeholder="--"
                                            id="first_name"
                                            label="First&nbsp;Name"
                                            type="text"
                                            value={previewPanel?.first_name || ''}
                                            className="h-8"
                                            onChange={(e) =>
                                                setPreviewPanel((prev) => ({
                                                    ...prev,
                                                    first_name: e.target.value.toUpperCase(),
                                                }))
                                            }
                                        />
                                        <InputLabelCombo
                                            placeholder="--"
                                            id="last_name"
                                            label="Last&nbsp;Name"
                                            type="text"
                                            className="h-8"
                                            value={previewPanel?.last_name || ''}
                                            onChange={(e) =>
                                                setPreviewPanel((prev) => ({
                                                    ...prev,
                                                    last_name: e.target.value.toUpperCase(),
                                                }))
                                            }
                                        />
                                        <InputLabelCombo
                                            id="profile_picture"
                                            label="Profile&nbsp;Picture"
                                            type="file"
                                            className="h-8"
                                            onChange={handleFileChange}
                                            disabled={previewPanel === null}
                                        />
                                        <InputLabelCombo
                                            placeholder="--"
                                            id="title"
                                            label="Job Title"
                                            type="text"
                                            value={previewPanel?.title || ''}
                                            className="h-8"
                                            onChange={(e) =>
                                                setPreviewPanel((prev) => ({
                                                    ...prev,
                                                    title: e.target.value,
                                                }))
                                            }
                                        />
                                        <InputLabelCombo
                                            placeholder="--"
                                            id="contact"
                                            label="Contact #"
                                            type="text"
                                            value={previewPanel?.contact || ''}
                                            className="h-8"
                                            onChange={(e) =>
                                                setPreviewPanel((prev) => ({
                                                    ...prev,
                                                    contact: e.target.value,
                                                }))
                                            }
                                        />
                                        <InputLabelCombo
                                            placeholder="--"
                                            id="blood_type"
                                            label="Blood Type"
                                            type="text"
                                            value={previewPanel?.blood_type || ''}
                                            className="h-8"
                                            onChange={(e) =>
                                                setPreviewPanel((prev) => ({
                                                    ...prev,
                                                    blood_type: e.target.value,
                                                }))
                                            }
                                        />
                                    </div>
                                    <div className="mt-3 flex items-center justify-end gap-x-3">
                                        <div className="text-xs text-slate-300">
                                            shift+click delete button to permanent delete
                                        </div>
                                        {!saveButtonDisabled && (
                                            <div className="text-sm text-red-500">
                                                Unsaved Changes
                                            </div>
                                        )}
                                        <Button
                                            variant="outline"
                                            onClick={handleEditSave}
                                            disabled={saveButtonDisabled}
                                        >
                                            Confirm
                                        </Button>
                                        <Button variant="outline" onClick={handleDelete}>
                                            Delete
                                        </Button>
                                    </div>
                                </div>
                            </div>

                            {/* right panel */}
                            <div className="flex flex-1 flex-col overflow-y-scroll bg-white p-3 shadow-sm sm:rounded-lg">
                                {cards.map((card, index) => (
                                    <div key={index}>
                                        <button
                                            className={`group flex w-full flex-wrap gap-2 rounded-md border-[1px] border-slate-300 ${card.id === previewPanel?.id ? 'bg-slate-200' : 'bg-white'} p-2 transition-all hover:bg-slate-200`}
                                            onClick={() => setPreviewPanel(card)}
                                        >
                                            {Object.entries(card).map(
                                                ([key, value]) =>
                                                    !omittedKeys.includes(key) && (
                                                        <div
                                                            key={key}
                                                            className={`rounded-md bg-slate-200 px-2 py-1 text-sm ${card.id === previewPanel?.id ? 'bg-slate-400/90' : 'bg-slate-200'} transition-all group-hover:bg-slate-400/90`}
                                                        >
                                                            <span className="font-bold">
                                                                {key}:
                                                            </span>
                                                            &nbsp;{value}
                                                        </div>
                                                    ),
                                            )}
                                        </button>
                                        {index !== cards.length - 1 && (
                                            <div className="my-4 h-0 w-full border-[1px] border-b-slate-300" />
                                        )}
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
