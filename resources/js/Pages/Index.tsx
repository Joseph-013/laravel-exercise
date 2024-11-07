import { Button } from '@/Components/ui/button';
import { Link } from '@inertiajs/react';
import { FunctionComponent } from 'react';

// eslint-disable-next-line prettier/prettier
interface IndexProps {}

const Index: FunctionComponent<IndexProps> = () => {
    return (
        <div className="flex min-h-screen w-screen items-center justify-center">
            <div className="flex max-w-[30rem] flex-col">
                <div className="flex justify-center gap-x-4">
                    <img
                        src={route('image', 'id_template_left.jpg')}
                        className="aspect-auto w-[15rem]"
                        alt=""
                    />
                    <img
                        src={route('image', 'id_template_right.jpg')}
                        className="aspect-auto w-[15rem]"
                        alt=""
                    />
                </div>
                <span className="mt-5 w-full text-center text-2xl font-bold">
                    Welcome to ID Maker!
                </span>
                <div className="mt-10 flex w-full justify-center gap-x-4">
                    <Button asChild>
                        <Link href={route('login')}>Log In</Link>
                    </Button>
                    <Button asChild>
                        <Link href={route('register')}>Sign Up</Link>
                    </Button>
                </div>
            </div>
        </div>
    );
};

export default Index;
