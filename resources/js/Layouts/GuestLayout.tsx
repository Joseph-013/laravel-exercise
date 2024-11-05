import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';
import { IconArrowBackUp } from '@tabler/icons-react';
import { PropsWithChildren } from 'react';

export default function Guest({ children }: PropsWithChildren) {
    return (
        <div className="flex min-h-screen flex-col items-center justify-center bg-gray-100 pt-6 sm:pt-0">
            <div>
                <Link href="/">
                    <ApplicationLogo className="h-20 w-20 fill-current text-gray-500" />
                </Link>
            </div>
            <div className="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
                {children}
                <Link
                    href="/"
                    className="mt-7 flex w-full justify-end gap-x-1 hover:underline"
                >
                    <IconArrowBackUp /> Return Home
                </Link>
            </div>
        </div>
    );
}
