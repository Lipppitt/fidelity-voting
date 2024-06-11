export type PollOption = {
    label: string;
    value: number;
}

export type Poll = {
    id: number;
    title: string;
    options: PollOption[];
}

export type UserVote = {
    id: number;
    option_id: number;
    poll_id: number;
    user_id: number;
}
