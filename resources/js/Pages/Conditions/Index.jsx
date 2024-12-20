// resources/js/Pages/Conditions/Index.jsx
import { useForm } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function Index({ auth, message }) {
    const { data, setData, post, processing, reset } = useForm({
        is_high: null,
        condition: null,
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('conditions.store'), {
            onSuccess: () => {
                reset();
            },
        });
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {message && (
                        <div className="mb-4 p-4 bg-green-100 rounded">
                            {message}
                        </div>
                    )}

                    <form onSubmit={submit}>
                        <div className="mb-4">
                            <h2>今日は「高まっている」?「高まっていない」?</h2>
                            <div className="mt-2 space-y-2">
                                <button
                                    type="button"
                                    onClick={() => setData('is_high', true)}
                                    className={`w-full p-2 rounded ${
                                        data.is_high === true ? 'bg-blue-500 text-white' : 'bg-white'
                                    }`}
                                >
                                    高まっている
                                </button>
                                <button
                                    type="button"
                                    onClick={() => setData('is_high', false)}
                                    className={`w-full p-2 rounded ${
                                        data.is_high === false ? 'bg-blue-500 text-white' : 'bg-white'
                                    }`}
                                >
                                    高まっていない
                                </button>
                            </div>
                        </div>

                        <div className="mb-4">
                            <h2>今日の体調は？</h2>
                            <div className="mt-2 grid grid-cols-4 gap-2">
                                {['良い', 'やや良い', 'やや悪い', '悪い'].map((condition) => (
                                    <button
                                        key={condition}
                                        type="button"
                                        onClick={() => setData('condition', condition)}
                                        className={`p-2 rounded ${
                                            data.condition === condition ? 'bg-blue-500 text-white' : 'bg-white'
                                        }`}
                                    >
                                        {condition}
                                    </button>
                                ))}
                            </div>
                        </div>

                        <button
                            type="submit"
                            disabled={processing || !data.is_high || !data.condition}
                            className="w-full bg-black text-white p-3 rounded disabled:opacity-50"
                        >
                            登録する
                        </button>
                    </form>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}