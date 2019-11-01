export interface IEndpoint {
    GetComic: string;
    GetNovel: string;
}

export interface ICominovelProps {
    currentID: BigInt;
    endpoints: IEndpoint[];
    languages: any;
    messages: any;
}
