import { InputDiv } from '@/components/form/container/input-div';
import InputFieldset from '@/components/form/input-fieldset';
import { Input } from '@/components/ui/input';
// Define InputDivData locally if not exported from '@/types'
type InputDivData = {
    data: Record<string, any>;
    setData: (key: string, value: any) => void;
    errors: Record<string, string[]>;
};

type Props = {
    inputDivData: InputDivData;
    data: {
        courses: {
            name: string;
            university: string;
            marks: number;
            passing_year: number;
        }[];
    };
    setData: (data: any) => void;
};

export default function Education({ inputDivData, data, setData }: Props) {
    const courses = data.courses;

    const addOrganiser = () => {
        setData({
            ...data,
            courses: [
                ...courses,
                { name: '', university: '', marks: 0, passing_year: 0 },
            ],
        });
    };

    const removeOrganiser = (index: number) => {
        setData({
            ...data,
            courses: courses.filter((_, i) => i !== index),
        });
    };

    const updateOrganiser = (
        index: number,
        key: 'name' | 'university' | 'marks' | 'passing_year',
        value: string | number,
    ) => {
        const updated = [...courses];
        (updated[index][key] as string | number) = value;
        setData({
            ...data,
            courses: updated,
        });
    };

    const initialOrganiser = [
        { name: 'Matriculation', university: '', marks: '', passing_year: '' },
        { name: 'Secondary School', university: '', marks: '', passing_year: '' },
    ];

    if (courses.length === 0) {
        setData({
            ...data,
            courses: initialOrganiser,
        });
    }

    return (
        <InputFieldset
            legend="Education"
            description=" Provide your educational qualifications."
        >
            <h1 className="text-lg font-semibold"> Courses </h1>
            {courses.map((course, index) => (
                <div key={index} className="my-3 rounded-md bg-green-50 p-4">
                    <div className="text-right">
                        {courses.length > 1 && (
                        <button
                            type="button"
                            onClick={() => removeOrganiser(index)}
                            className="text-xl bg-red-500 hover:bg-red-700 px-3 py-1 text-white rounded-sm cursor-pointer"
                        >
                            &times;
                        </button>
                    )}
                    </div>
                    <div className="flex items-center gap-4">
                        <InputDiv
                            type="text"
                            label="Course Title"
                            placeholder="Matriculation / High School"
                            value={course.name}
                            onChange={(e) =>
                                updateOrganiser(index, 'name', e.target.value)
                            }
                            className="flex-1"
                        />
                        <InputDiv
                            type="text"
                            label="Board/University"
                            placeholder="Delhi University"
                            value={course.university}
                            onChange={(e) =>
                                updateOrganiser(
                                    index,
                                    'university',
                                    e.target.value,
                                )
                            }
                            className="flex-1"
                        />
                        <InputDiv
                            type="number"
                            label="Marks"
                            placeholder="85"
                            value={course.marks}
                            onChange={(e) =>
                                updateOrganiser(index, 'marks', e.target.value)
                            }
                            className="flex-1"
                        />

                        <InputDiv
                            type="number"
                            label="Passing Year"
                            placeholder="2020"
                            value={course.passing_year}
                            onChange={(e) =>
                                updateOrganiser(
                                    index,
                                    'passing_year',
                                    e.target.value,
                                )
                            }
                            className="flex-1"
                        />
                    </div>
                    <InputDiv
                        type="file"
                        label="Certificate / Marksheet "
                        name="certificate_marksheet"
                        inputDivData={inputDivData}
                    />

                    
                </div>
            ))}
            <button
                type="button"
                onClick={addOrganiser}
                className="mt-2 text-sm bg-blue-600 hover:bg-blue-800 px-4 py-2 text-white rounded-md cursor-pointer"
            >
                + Add New Course
            </button>
        </InputFieldset>
    );
}
