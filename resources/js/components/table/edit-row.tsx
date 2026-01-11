import Button from '@/components/button';
export default function EditRow({children, trClassName, tdClassName, buttonClassName, divClassName, href, buttonName }: { children?: React.ReactNode, trClassName?: string, tdClassName?: string, divClassName?: string, buttonClassName?: string, href: string, buttonName?: string }) {
    return (
        <tr className={trClassName}>
            <td className={`${tdClassName} p-3`} colSpan={2}>
                <div className={`flex justify-center ${divClassName}`}>
                    <Button className={buttonClassName} size='full'  href={href}>{ children || buttonName || 'Edit'} </Button>
                </div>
            </td>
        </tr>
    );
}