import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';

export default function InputLabelCombo({
    id,
    label,
    ...props
}: {
    id: string;
    label: string;
} & React.InputHTMLAttributes<HTMLInputElement>) {
    return (
        <div className="flex flex-col items-start gap-2">
            <Label htmlFor={id}>{label}:</Label>
            <Input id={id} {...props} autoComplete="off" />
        </div>
    );
}
