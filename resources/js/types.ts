export type PollOption = {
    label: string;
    value: number;
}

export type Poll = {
    id: number;
    title: string;
    options: PollOption[];
}
